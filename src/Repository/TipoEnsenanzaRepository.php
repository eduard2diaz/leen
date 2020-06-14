<?php

namespace App\Repository;

use App\Entity\TipoEnsenanza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoEnsenanza|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoEnsenanza|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoEnsenanza[]    findAll()
 * @method TipoEnsenanza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoEnsenanzaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoEnsenanza::class);
    }

    // /**
    //  * @return TipoEnsenanza[] Returns an array of TipoEnsenanza objects
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
    public function findOneBySomeField($value): ?TipoEnsenanza
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
