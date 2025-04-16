<?php

namespace App\Repository;

use App\Entity\ReservationPack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationPack>
 *
 * @method ReservationPack|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationPack|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationPack[]    findAll()
 * @method ReservationPack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationPackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationPack::class);
    }

    public function save(ReservationPack $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReservationPack $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByUser(int $userId)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.user = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('r.created_at', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByStatut(string $statut)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.statut_reservation = :statut')
            ->setParameter('statut', $statut)
            ->orderBy('r.created_at', 'DESC')
            ->getQuery()
            ->getResult();
    }
} 