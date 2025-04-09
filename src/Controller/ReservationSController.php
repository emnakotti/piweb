<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationRepository;
use App\Repository\ServiceRepository;
use App\Entity\Service;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ReservationSController extends AbstractController
{

    #[Route('/catalogueS', name: 'Cataloguepage')]
    public function index(): Response
    {
        return $this->render('CatalogueResS.html.twig');
    }



    #[Route('/catalogue/servicesM', name: 'app_catalogue_servicesM')]
    public function listServices(ServiceRepository $serviceRepository): Response
    {
        // Récupère uniquement les services de type "Matériel"
        $services = $serviceRepository->findBy(['typeService' => 'Matériel']);

        return $this->render('CataloguesSM.html.twig', [
            'services' => $services,
        ]);
    }
    // src/Controller/ServiceController.php

    #[Route('/service/{idService}', name: 'service_detail')]


    public function showDetail(
        int $idService,
        ServiceRepository $serviceRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $service = $serviceRepository->find($idService);
        if (!$service) {
            throw $this->createNotFoundException('Service non trouvé');
        }

        // Création du formulaire de réservation
        $reservation = new Reservation();
        $reservation->setService($service);
        $reservation->setUtilisateur($this->getUser());

        $reservationForm = $this->createForm(ReservationType::class, $reservation, [
            'max_quantity' => $service->getDisponibilite(),
            'action' => $this->generateUrl('app_reservation_new', ['id' => $service->getIdService()])
        ]);

        return $this->render('detailS.html.twig', [
            'service' => $service,
            'reservationForm' => $reservationForm->createView()
        ]);
    }

    #[Route('/catalogue/servicesS', name: 'app_catalogue_servicesS')]
    public function listServices1(ServiceRepository $serviceRepository): Response
    {
        // Récupère uniquement les services de type "Matériel"
        $services = $serviceRepository->findBy(['typeService' => 'Staff']);

        return $this->render('CataloguesSS.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/service/{id}/reserver', name: 'app_reservation_new')]
    public function new(
        int $id,
        Request $request,
        ServiceRepository $serviceRepository,
        EntityManagerInterface $em,
        ValidatorInterface $validator
    ): Response {
        $service = $serviceRepository->find($id);
        if (!$service) {
            throw $this->createNotFoundException('Service non trouvé');
        }

        if ($service->getQuantiteMateriel() <= 0) {
            $this->addFlash('error', 'Ce service n\'est plus disponible pour réservation');
            return $this->redirectToRoute('service_detail', ['idService' => $id]);
        }

        $reservation = new Reservation();
        $reservation->setService($service);
        $reservation->setUtilisateur($this->getUser());
        $reservation->setDateReservation(new \DateTime()); // Initialisation de la date

        $form = $this->createForm(ReservationType::class, $reservation, [
            'max_quantity' => $service->getQuantiteMateriel()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // Validation manuelle supplémentaire si nécessaire
            $errors = $validator->validate($reservation);
            if (count($errors) > 0 || !$form->isValid()) {
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
                return $this->redirectToRoute('service_detail', ['idService' => $id]);
            }

            try {
                // Traitement de la réservation
                $quantiteReservee = $reservation->getQuantite();
                $nouvelleQuantite = $service->getQuantiteMateriel() - $quantiteReservee;

                $service->setQuantiteMateriel($nouvelleQuantite);
                if ($nouvelleQuantite === 0) {
                    $service->setDisponibilite(0);
                    $this->addFlash('warning', 'Stock épuisé!');
                }

                $em->persist($reservation);
                $em->flush();

                $this->addFlash('success', 'Réservation enregistrée! Stock restant: ' . $nouvelleQuantite);
                return $this->redirectToRoute('service_detail', ['idService' => $id]);
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de la réservation');
                // Log l'erreur si nécessaire
                // $this->logger->error($e->getMessage());
                return $this->redirectToRoute('service_detail', ['idService' => $id]);
            }
        }

        return $this->render('detailS.html.twig', [
            'reservationForm' => $form->createView(),
            'service' => $service
        ]);
    }

    #[Route('/reservations', name: 'app_reservations_list')]
    public function listReservations(ReservationRepository $reservationRepo): Response
    {
        // Récupère toutes les réservations (ou celles de l'utilisateur connecté)
        $reservations = $reservationRepo->findAll();
        // Ou pour l'utilisateur courant : $reservations = $reservationRepo->findBy(['utilisateur' => $this->getUser()]);

        return $this->render('listReservationS.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/reservation/{id}/edit', name: 'app_reservation_edit')]
    public function edit(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $reservation = $em->getRepository(Reservation::class)->find($id);

        if (!$reservation) {
            throw $this->createNotFoundException('La réservation demandée n\'existe pas');
        }

        // Vérification des autorisations avant toute modification
        if ($reservation->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à modifier cette réservation');
        }

        // Initialisation de la date si null (avec le timezone par défaut)
        if (null === $reservation->getDateReservation()) {
            $reservation->setDateReservation(new \DateTime('now', new \DateTimeZone('Europe/Paris')));
        }

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                try {
                    $em->flush();
                    $this->addFlash('success', 'La réservation a été mise à jour avec succès');
                    return $this->redirectToRoute('app_reservations_list');
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de la mise à jour');
                    // Log l'erreur si nécessaire
                    // $this->logger->error($e->getMessage());
                }
            } else {
                $this->addFlash('warning', 'Veuillez corriger les erreurs dans le formulaire');
            }
        }

        return $this->render('edit.html.twig', [
            'form' => $form->createView(),
            'reservation' => $reservation,
        ]);
    }

    #[Route('/reservation/{id}/delete', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $reservation = $em->getRepository(Reservation::class)->find($id);

        if (!$reservation) {
            throw $this->createNotFoundException('Réservation non trouvée');
        }

        // Vérifiez que l'utilisateur peut supprimer cette réservation
        if ($reservation->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $reservation->getIdReservation(), $request->request->get('_token'))) {
            $em->remove($reservation);
            $em->flush();
            $this->addFlash('success', 'Réservation supprimée avec succès');
        }

        return $this->redirectToRoute('app_reservations_list');
    }
}
