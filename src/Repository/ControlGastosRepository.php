<?php

namespace App\Repository;

use App\Entity\ControlGastos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ControlGastos|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControlGastos|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControlGastos[]    findAll()
 * @method ControlGastos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControlGastosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ControlGastos::class);
    }

    public function findActivos($escuela)
    {
        return $this->createQueryBuilder('cg')
            ->join('cg.proyecto','p')
            ->join('p.escuela','e')
            ->join('cg.estatus','es')
            ->andWhere('es.estatus = :val')
            ->andWhere('e.id = :escuela')
            ->setParameter('val', 'Activo')
            ->setParameter('escuela', $escuela)
            ->getQuery()
            ->getResult();
    }
}
