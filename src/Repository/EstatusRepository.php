<?php

namespace App\Repository;

use App\Entity\Estatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Estatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estatus[]    findAll()
 * @method Estatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estatus::class);
    }

    // /**
    //  * @return Estatus[] Returns an array of Estatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Estatus
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
