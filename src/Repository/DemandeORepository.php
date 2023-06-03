<?php

namespace App\Repository;

use App\Entity\DemandeO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeO|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeO|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeO[]    findAll()
 * @method DemandeO[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeORepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeO::class);
    }

    // /**
    //  * @return DemandeO[] Returns an array of DemandeO objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemandeO
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
    * returns number of "Demandes" per day
    * @return void 
    */

    public function countByDate(){

       $query = $this-> createQueryBuilder('a')
       ->select('SUBSTRING(a.date,1,10)AS date_demande, COUNT(a)as count')
       ->groupBy('date_demande');
       return $query->getQuery()->getResult();




    }
}
