<?php

namespace App\Repository;

use App\Entity\Hogar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Hogar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hogar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hogar[]    findAll()
 * @method Hogar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HogarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hogar::class);
    }

    // /**
    //  * @return Hogar[] Returns an array of Hogar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hogar
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
