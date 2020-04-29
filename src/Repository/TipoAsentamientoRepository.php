<?php

namespace App\Repository;

use App\Entity\TipoAsentamiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoAsentamiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoAsentamiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoAsentamiento[]    findAll()
 * @method TipoAsentamiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoAsentamientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoAsentamiento::class);
    }

    // /**
    //  * @return TipoAsentamiento[] Returns an array of TipoAsentamiento objects
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
    public function findOneBySomeField($value): ?TipoAsentamiento
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
