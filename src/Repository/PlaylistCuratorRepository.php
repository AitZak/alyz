<?php

namespace App\Repository;

use App\Entity\PlaylistCurator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlaylistCurator|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaylistCurator|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaylistCurator[]    findAll()
 * @method PlaylistCurator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaylistCuratorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaylistCurator::class);
    }

    // /**
    //  * @return PlaylistCurator[] Returns an array of PlaylistCurator objects
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
    public function findOneBySomeField($value): ?PlaylistCurator
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
