<?php

namespace App\Repository;

use App\Entity\Sing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sing[]    findAll()
 * @method Sing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sing::class);
    }

    // /**
    //  * @return Sing[] Returns an array of Sing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sing
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
