<?php

namespace App\Repository;

use App\Entity\CondicionEducativaAlumnos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CondicionEducativaAlumnos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CondicionEducativaAlumnos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CondicionEducativaAlumnos[]    findAll()
 * @method CondicionEducativaAlumnos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CondicionEducativaAlumnosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CondicionEducativaAlumnos::class);
    }

    // /**
    //  * @return CondicionEducativaAlumnos[] Returns an array of CondicionEducativaAlumnos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CondicionEducativaAlumnos
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
