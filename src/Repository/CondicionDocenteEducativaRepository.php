<?php

namespace App\Repository;

use App\Entity\CondicionDocenteEducativa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CondicionDocenteEducativa|null find($id, $lockMode = null, $lockVersion = null)
 * @method CondicionDocenteEducativa|null findOneBy(array $criteria, array $orderBy = null)
 * @method CondicionDocenteEducativa[]    findAll()
 * @method CondicionDocenteEducativa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CondicionDocenteEducativaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CondicionDocenteEducativa::class);
    }

    // /**
    //  * @return CondicionDocenteEducativa[] Returns an array of CondicionDocenteEducativa objects
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
    public function findOneBySomeField($value): ?CondicionDocenteEducativa
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
