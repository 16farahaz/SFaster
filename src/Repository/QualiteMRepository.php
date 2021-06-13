<?php

namespace App\Repository;

use App\Entity\QualiteM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QualiteM|null find($id, $lockMode = null, $lockVersion = null)
 * @method QualiteM|null findOneBy(array $criteria, array $orderBy = null)
 * @method QualiteM[]    findAll()
 * @method QualiteM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QualiteMRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QualiteM::class);
    }

    // /**
    //  * @return QualiteM[] Returns an array of QualiteM objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QualiteM
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
