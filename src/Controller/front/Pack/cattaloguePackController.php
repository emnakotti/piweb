<?php

namespace App\Controller\front\Pack;

use App\Entity\PackEvenement;
use App\Form\PackEvenementType;
use App\Entity\Locaux;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cattagPack')]
class cattaloguePackController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('', name: 'cattagPack')]
    public function index(): Response
    {
        $packs = $this->entityManager->getRepository(PackEvenement::class)->findAll();
        $lieux = $this->entityManager->getRepository(Locaux::class)->findAll();
        return $this->render('front/Pack/cattaloguePack.html.twig', [
            'packs' => $packs,
            'lieux' => $lieux
        ]);
    }

    #[Route('/{id}', name: 'cattagPack_show', methods: ['GET'])]
    public function show(PackEvenement $pack): Response
    {
        return $this->render('front/Pack/show.html.twig', [
            'pack' => $pack
        ]);
    }


    #[Route('/packs/filter', name: 'pack_filter_dql', methods: ['GET'])]
    public function filterDQL(Request $request, EntityManagerInterface $em): Response
    {
        $lieu = $request->query->get('lieu');
        $capacite = $request->query->get('capacite');
        $type = $request->query->get('type');
        $date = $request->query->get('date');
    
        // Toujours récupérer tous les lieux pour la liste déroulante
        $lieux = $em->createQueryBuilder()
            ->select('DISTINCT l')
            ->from('App\Entity\Locaux', 'l')
            ->leftJoin('App\Entity\PackEvenement', 'p', 'WITH', 'p.lieu = l')
            ->where('l IS NOT NULL')
            ->getQuery()
            ->getResult();
    
        // Construire la requête pour filtrer les packs
        $qb = $em->createQueryBuilder()
            ->select('p')
            ->from(PackEvenement::class, 'p')
            ->leftJoin('p.lieu', 'l');
    
        if ($lieu) {
            $qb->andWhere('l.idLocal = :lieu')->setParameter('lieu', $lieu);
        }
    
        if ($type) {
            $qb->andWhere('p.type = :type')->setParameter('type', $type);
        }
    
        if ($date) {
            $qb->andWhere('p.dateDebut >= :date')->setParameter('date', new \DateTime($date));
        }
    
        if ($capacite) {
            if ($capacite === '20-50') {
                $qb->andWhere('p.nbreInvitesMax BETWEEN 20 AND 50');
            } elseif ($capacite === '50-100') {
                $qb->andWhere('p.nbreInvitesMax BETWEEN 50 AND 100');
            } elseif ($capacite === '100+') {
                $qb->andWhere('p.nbreInvitesMax > 100');
            }
        }
    
        $packs = $qb->getQuery()->getResult();
    
        return $this->render('front/Pack/cattaloguePack.html.twig', [
            'packs' => $packs,
            'lieux' => $lieux, // Toujours passer les lieux au template
        ]);
    }
}
