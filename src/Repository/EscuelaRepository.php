<?php

namespace App\Repository;

use App\Entity\Escuela;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Escuela|null find($id, $lockMode = null, $lockVersion = null)
 * @method Escuela|null findOneBy(array $criteria, array $orderBy = null)
 * @method Escuela[]    findAll()
 * @method Escuela[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EscuelaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Escuela::class);
    }

    // /**
    //  * @return Escuela[] Returns an array of Escuela objects
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
    public function findOneBySomeField($value): ?Escuela
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
