<?php

namespace App\Repository;

use App\Entity\PackEvenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PackEvenement>
 *
 * @method PackEvenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method PackEvenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method PackEvenement[]    findAll()
 * @method PackEvenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackEvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PackEvenement::class);
    }

    public function save(PackEvenement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PackEvenement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return PackEvenement[] Returns an array of PackEvenement objects
     */
    public function findByType(string $type): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.type = :type')
            ->setParameter('type', $type)
            ->orderBy('p.prix', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return PackEvenement[] Returns an array of PackEvenement objects
     */
    public function findByStatut(string $statut): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.statut = :statut')
            ->setParameter('statut', $statut)
            ->orderBy('p.dateCreation', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    // src/Repository/PackEvenementRepository.php

public function findByFilters($lieuId = null, $nbreInvites = null, $typeEvenement = null)
{
    $qb = $this->createQueryBuilder('p')
        ->orderBy('p.dateCreation', 'DESC');

    if ($lieuId) {
        $qb->andWhere('p.lieu = :lieuId')
           ->setParameter('lieuId', $lieuId);
    }

    if ($nbreInvites) {
        // Par exemple, pour filtrer la capacité minimale
        $qb->andWhere('p.nbreInvitesMax >= :nbreInvites')
           ->setParameter('nbreInvites', $nbreInvites);
    }

    if ($typeEvenement) {
        $qb->andWhere('p.type = :typeEvenement')
           ->setParameter('typeEvenement', $typeEvenement);
    }

    return $qb->getQuery()->getResult();
}

} 