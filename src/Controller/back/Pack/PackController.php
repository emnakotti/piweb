<?php

namespace App\Controller\back\Pack;

use App\Entity\PackEvenement;
use App\Entity\Locaux;
use App\Form\PackEvenementType;
use App\Repository\PackEvenementRepository;
use App\Repository\LocauxRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/back/pack')]
class PackController extends AbstractController
{
    private $entityManager;
    private $packRepository;
    private $locauxRepository;
    private $serviceRepository;
    private $slugger;

    public function __construct(
        EntityManagerInterface $entityManager,
        PackEvenementRepository $packRepository,
        LocauxRepository $locauxRepository,
        ServiceRepository $serviceRepository,
        SluggerInterface $slugger
    ) {
        $this->entityManager = $entityManager;
        $this->packRepository = $packRepository;
        $this->locauxRepository = $locauxRepository;
        $this->serviceRepository = $serviceRepository;
        $this->slugger = $slugger;
    }

    #[Route('/allPacks', name: 'back_pack_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('back/Pack/index.html.twig', [
            'packs' => $this->packRepository->findAll(),
        ]);
    }

    #[Route('/newPack', name: 'back_pack_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $packEvenement = new PackEvenement();
        $form = $this->createForm(PackEvenementType::class, $packEvenement, [
            'attr' => ['id' => 'pack-form']
        ]);
        $form->handleRequest($request);
    
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // Récupération du nom de la photo uploadée
                if ($filename = $request->request->get('uploaded_photo')) {
                    $packEvenement->setPhoto($filename);
                }
                // Gestion du lieu...
                $lieu = $form->get('lieu')->getData();
                if ($lieu instanceof Locaux) {
                    $packEvenement->setLieu($lieu);
                }
    
                $this->entityManager->persist($packEvenement);
                $this->entityManager->flush();
    
                // Si AJAX, on renvoie du JSON
                if ($request->isXmlHttpRequest()) {
                    return $this->json([
                        'success'     => true,
                        'message'     => 'Pack créé avec succès',
                        'redirectUrl' => $this->generateUrl('back_pack_index'),
                    ], Response::HTTP_CREATED);
                }
    
                // Sinon soumission classique
                $this->addFlash('success', 'Pack créé avec succès');
                return $this->redirectToRoute('back_pack_index');
            }
    
            // En cas d’erreurs et si AJAX
            if ($request->isXmlHttpRequest()) {
                $errors = [];
                foreach ($form->getErrors(true) as $e) {
                    $errors[$e->getOrigin()->getName()] = $e->getMessage();
                }
                return $this->json([
                    'success' => false,
                    'errors'  => $errors,
                ], Response::HTTP_BAD_REQUEST);
            }
        }
    
        return $this->render('back/Pack/new.html.twig', [
            'pack_evenement' => $packEvenement,
            'form'           => $form->createView(),
        ]);
    }
    

    #[Route('/{id}/edit', name: 'back_pack_edit', methods: ['GET','POST'])]
    public function edit(Request $request, PackEvenement $pack): Response
    {
        $form = $this->createForm(PackEvenementType::class, $pack, [
            'attr' => ['id' => 'pack-form'],
        ]);
        $form->handleRequest($request);
    
        if ($form->isSubmitted()) {
            try {
                // 1. Suppression de la photo si demandé
                if ($request->request->get('remove_photo') === '1' && $pack->getPhoto()) {
                    $oldFile = $this->getParameter('packs_directory').'/'.$pack->getPhoto();
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                    $pack->setPhoto(null);
                }
    
                // 2. Traitement du nouveau fichier uploadé
                $photoFile = $form->get('photoFile')->getData();
                if ($photoFile) {
                    $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename     = preg_replace('/[^A-Za-z0-9_]/', '', strtolower($originalFilename));
                    $newFilename      = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();
    
                    $photoFile->move(
                        $this->getParameter('packs_directory'),
                        $newFilename
                    );
    
                    // Supprimer l'ancienne photo si elle existe encore
                    if ($pack->getPhoto()) {
                        $oldFile = $this->getParameter('packs_directory').'/'.$pack->getPhoto();
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
    
                    $pack->setPhoto($newFilename);
                }
    
                // 3. Mise à jour de l'entité Lieu
                $lieu = $form->get('lieu')->getData();
                if ($lieu instanceof Locaux) {
                    $pack->setLieu($lieu);
                }
    
                // 4. Validation et persistance
                if ($form->isValid()) {
                    $this->entityManager->flush();
    
                    // Si AJAX, on renvoie du JSON
                    if ($request->isXmlHttpRequest()) {
                        return $this->json([
                            'success'     => true,
                            'message'     => 'Pack modifié avec succès',
                            'redirectUrl' => $this->generateUrl('back_pack_index'),
                        ], Response::HTTP_OK);
                    }
    
                    // Soumission classique
                    $this->addFlash('success', 'Pack modifié avec succès');
                    return $this->redirectToRoute('back_pack_index');
                }
    
                // En cas d’erreurs de validation et si AJAX, on renvoie le détail des erreurs
                if ($request->isXmlHttpRequest()) {
                    $errors = [];
                    foreach ($form->getErrors(true) as $error) {
                        $field = $error->getOrigin()->getName();
                        $errors[$field] = $error->getMessage();
                    }
                    return $this->json([
                        'success' => false,
                        'errors'  => $errors,
                    ], Response::HTTP_BAD_REQUEST);
                }
    
            } catch (\Exception $e) {
                // Gestion d’exception
                if ($request->isXmlHttpRequest()) {
                    return $this->json([
                        'success' => false,
                        'errors'  => ['exception' => $e->getMessage()],
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
                $this->addFlash('error', 'Erreur lors de la modification du pack : ' . $e->getMessage());
                return $this->redirectToRoute('back_pack_edit', ['id' => $pack->getPackId()]);
            }
        }
    
        // Affichage du formulaire (GET ou premières fois)
        return $this->render('back/Pack/edit.html.twig', [
            'pack' => $pack,
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/{id}/delete', name: 'back_pack_delete', methods: ['POST'])]
    public function delete(Request $request, PackEvenement $pack): JsonResponse
    {
        try {
            // Vérifier le token CSRF
            if (!$this->isCsrfTokenValid('delete', $request->request->get('_token'))) {
                return new JsonResponse(['success' => false, 'message' => 'Token CSRF invalide'], 400);
            }

            // Supprimer la photo si elle existe
            if ($pack->getPhoto()) {
                $filePath = $this->getParameter('packs_directory') . '/' . $pack->getPhoto();
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Supprimer le pack
            $this->entityManager->remove($pack);
            $this->entityManager->flush();

            return new JsonResponse([
                'success' => true,
                'message' => 'Pack supprimé avec succès'
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Erreur lors de la suppression du pack'
            ], 500);
        }
    }


    #[Route('/{id}/toggle-status', name: 'back_pack_toggle_status', methods: ['POST'])]
    public function toggleStatus(PackEvenement $pack): JsonResponse
    {
        $newStatus = $pack->isActive() ? 'inactif' : 'actif';
        $pack->setStatut($newStatus);
        
        $this->entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'newStatus' => $newStatus,
            'message' => 'Statut modifié avec succès'
        ]);
    }

    #[Route('/upload-photo', name: 'back_pack_upload_photo', methods: ['POST'])]
    public function uploadPhoto(Request $request): JsonResponse
    {
        try {
            $photo = $request->files->get('photoFile');
            
            if (!$photo) {
                return new JsonResponse(['success' => false, 'message' => 'Aucun fichier trouvé'], 400);
            }

            $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

            $photo->move(
                $this->getParameter('packs_directory'),
                $newFilename
            );

            return new JsonResponse([
                'success' => true,
                'filename' => $newFilename
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Erreur lors du téléchargement de l\'image'
            ], 500);
        }
    }
} 