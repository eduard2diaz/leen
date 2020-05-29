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

    public function findActivos($escuela)
    {
        return $this->createQueryBuilder('pt')
            ->join('pt.proyecto','p')
            ->join('p.escuela','e')
            ->join('pt.estatus','es')
            ->andWhere('es.estatus = :val')
            ->andWhere('e.id = :escuela')
            ->setParameter('val', 'Activo')
            ->setParameter('escuela', $escuela)
            ->getQuery()
            ->getResult();
    }
}
