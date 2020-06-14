<?php

namespace App\Repository;

use App\Entity\CCTS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CCTS|null find($id, $lockMode = null, $lockVersion = null)
 * @method CCTS|null findOneBy(array $criteria, array $orderBy = null)
 * @method CCTS[]    findAll()
 * @method CCTS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CCTSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CCTS::class);
    }

    // /**
    //  * @return CCTS[] Returns an array of CCTS objects
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
    public function findOneBySomeField($value): ?CCTS
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
