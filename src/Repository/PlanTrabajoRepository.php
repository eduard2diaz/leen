<?php

namespace App\Repository;

use App\Entity\PlanTrabajo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlanTrabajo|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanTrabajo|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanTrabajo[]    findAll()
 * @method PlanTrabajo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanTrabajoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanTrabajo::class);
    }

    // /**
    //  * @return PlanTrabajo[] Returns an array of PlanTrabajo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlanTrabajo
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
