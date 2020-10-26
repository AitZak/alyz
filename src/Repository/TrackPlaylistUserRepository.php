<?php

namespace App\Repository;

use App\Entity\TrackPlaylistUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrackPlaylistUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrackPlaylistUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrackPlaylistUser[]    findAll()
 * @method TrackPlaylistUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackPlaylistUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrackPlaylistUser::class);
    }

    // /**
    //  * @return TrackPlaylistUser[] Returns an array of TrackPlaylistUser objects
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
    public function findOneBySomeField($value): ?TrackPlaylistUser
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
