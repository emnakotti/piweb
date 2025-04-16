<?php

namespace App\Repository;

use App\Entity\Reacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reacts>
 *
 * @method Reacts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reacts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reacts[]    findAll()
 * @method Reacts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReactsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reacts::class);
    }

    public function save(Reacts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reacts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findUserReactionOnPost(int $userId, int $postId): ?Reacts
    {
        return $this->findOneBy([
            'user' => $userId,
            'post' => $postId
        ]);
    }
} 