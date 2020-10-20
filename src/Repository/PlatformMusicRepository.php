<?php

namespace App\Repository;

use App\Entity\PlatformMusic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlatformMusic|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlatformMusic|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlatformMusic[]    findAll()
 * @method PlatformMusic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatformMusicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlatformMusic::class);
    }

    // /**
    //  * @return PlatformMusic[] Returns an array of PlatformMusic objects
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
    public function findOneBySomeField($value): ?PlatformMusic
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
