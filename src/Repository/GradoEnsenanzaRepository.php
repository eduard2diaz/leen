<?php

namespace App\Repository;

use App\Entity\Escuela;
use App\Entity\GradoEnsenanza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GradoEnsenanza|null find($id, $lockMode = null, $lockVersion = null)
 * @method GradoEnsenanza|null findOneBy(array $criteria, array $orderBy = null)
 * @method GradoEnsenanza[]    findAll()
 * @method GradoEnsenanza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GradoEnsenanzaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GradoEnsenanza::class);
    }

    // /**
    //  * @return GradoEnsenanza[] Returns an array of GradoEnsenanza objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

}
