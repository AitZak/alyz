<?php

namespace App\Repository;

use App\Entity\TracksChart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TracksChart|null find($id, $lockMode = null, $lockVersion = null)
 * @method TracksChart|null findOneBy(array $criteria, array $orderBy = null)
 * @method TracksChart[]    findAll()
 * @method TracksChart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TracksChartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TracksChart::class);
    }

    // /**
    //  * @return TracksChart[] Returns an array of TracksChart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TracksChart
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
