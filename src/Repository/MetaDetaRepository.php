<?php

namespace App\Repository;

use App\Entity\MetaDeta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MetaDeta|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetaDeta|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetaDeta[]    findAll()
 * @method MetaDeta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaDetaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetaDeta::class);
    }

    // /**
    //  * @return MetaDeta[] Returns an array of MetaDeta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MetaDeta
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
