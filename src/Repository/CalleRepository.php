<?php

namespace App\Repository;

use App\Entity\Calle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Calle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calle[]    findAll()
 * @method Calle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calle::class);
    }

    // /**
    //  * @return Calle[] Returns an array of Calle objects
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
    public function findOneBySomeField($value): ?Calle
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
