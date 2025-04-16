<?php

namespace App\Repository;

use App\Entity\ReservationLocaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationLocaux>
 *
 * @method ReservationLocaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationLocaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationLocaux[]    findAll()
 * @method ReservationLocaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationLocauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationLocaux::class);
    }

    public function save(ReservationLocaux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReservationLocaux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByLocal(int $localId)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.local = :localId')
            ->setParameter('localId', $localId)
            ->orderBy('r.date_debut', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findOverlappingReservations(\DateTime $dateDebut, \DateTime $dateFin, int $localId)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.local = :localId')
            ->andWhere('r.date_debut <= :dateFin')
            ->andWhere('r.date_fin >= :dateDebut')
            ->setParameter('localId', $localId)
            ->setParameter('dateDebut', $dateDebut)
            ->setParameter('dateFin', $dateFin)
            ->getQuery()
            ->getResult();
    }
} 