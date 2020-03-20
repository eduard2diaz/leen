<?php

namespace App\Repository;

use App\Entity\RendicionCuentas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RendicionCuentas|null find($id, $lockMode = null, $lockVersion = null)
 * @method RendicionCuentas|null findOneBy(array $criteria, array $orderBy = null)
 * @method RendicionCuentas[]    findAll()
 * @method RendicionCuentas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendicionCuentasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RendicionCuentas::class);
    }

    // /**
    //  * @return RendicionCuentas[] Returns an array of RendicionCuentas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RendicionCuentas
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
