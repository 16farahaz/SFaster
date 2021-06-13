<?php

namespace App\Repository;

use App\Entity\GammeUsinage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GammeUsinage|null find($id, $lockMode = null, $lockVersion = null)
 * @method GammeUsinage|null findOneBy(array $criteria, array $orderBy = null)
 * @method GammeUsinage[]    findAll()
 * @method GammeUsinage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GammeUsinageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GammeUsinage::class);
    }

    // /**
    //  * @return GammeUsinage[] Returns an array of GammeUsinage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GammeUsinage
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
