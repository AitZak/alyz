<?php

namespace App\Repository;

use App\Entity\Curator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Curator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Curator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Curator[]    findAll()
 * @method Curator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuratorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Curator::class);
    }

    // /**
    //  * @return Curator[] Returns an array of Curator objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Curator
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
