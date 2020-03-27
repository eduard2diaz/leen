<?php

namespace App\Repository;

use App\Entity\ControlGastos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ControlGastos|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControlGastos|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControlGastos[]    findAll()
 * @method ControlGastos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControlGastosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ControlGastos::class);
    }

    // /**
    //  * @return ControlGastos[] Returns an array of ControlGastos objects
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
    public function findOneBySomeField($value): ?ControlGastos
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
