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

    public function getDateCharts()
    {
        return $this->createQueryBuilder('t')
            ->select("t.publication_date")
            ->groupBy("t.publication_date")
            ->orderBy("t.publication_date", 'DESC')
            ->getQuery()
            ->getArrayResult();
    }


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
