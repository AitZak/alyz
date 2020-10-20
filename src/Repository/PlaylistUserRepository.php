<?php

namespace App\Repository;

use App\Entity\PlaylistUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlaylistUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaylistUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaylistUser[]    findAll()
 * @method PlaylistUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaylistUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaylistUser::class);
    }

    // /**
    //  * @return PlaylistUser[] Returns an array of PlaylistUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlaylistUser
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
