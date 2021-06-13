<?php

namespace App\Repository;

use App\Entity\Gh;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gh|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gh|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gh[]    findAll()
 * @method Gh[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GhRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gh::class);
    }

    // /**
    //  * @return Gh[] Returns an array of Gh objects
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
    public function findOneBySomeField($value): ?Gh
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
