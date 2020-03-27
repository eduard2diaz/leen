<?php

namespace App\Repository;

use App\Entity\DiagnosticoPlantel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DiagnosticoPlantel|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiagnosticoPlantel|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiagnosticoPlantel[]    findAll()
 * @method DiagnosticoPlantel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiagnosticoPlantelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiagnosticoPlantel::class);
    }

    // /**
    //  * @return DiagnosticoPlantel[] Returns an array of DiagnosticoPlantel objects
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
    public function findOneBySomeField($value): ?DiagnosticoPlantel
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
