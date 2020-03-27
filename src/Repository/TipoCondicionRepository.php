<?php

namespace App\Repository;

use App\Entity\TipoCondicion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoCondicion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCondicion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCondicion[]    findAll()
 * @method TipoCondicion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoCondicionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCondicion::class);
    }

    // /**
    //  * @return TipoCondicion[] Returns an array of TipoCondicion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoCondicion
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
