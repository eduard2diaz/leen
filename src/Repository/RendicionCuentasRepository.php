<?php

namespace App\Repository;

use App\Entity\RendicionCuentas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RendicionCuentas|null find($id, $lockMode = null, $lockVersion = null)
 * @method RendicionCuentas|null findOneBy(array $criteria, array $orderBy = null)
 * @method RendicionCuentas[]    findAll()
 * @method RendicionCuentas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendicionCuentasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RendicionCuentas::class);
    }

    public function findActivos($escuela)
    {
        return $this->createQueryBuilder('rc')
            ->join('rc.proyecto','p')
            ->join('p.escuela','e')
            ->join('rc.estatus','es')
            ->andWhere('es.estatus = :val')
            ->andWhere('e.id = :escuela')
            ->setParameter('val', 'Activo')
            ->setParameter('escuela', $escuela)
            ->getQuery()
            ->getResult();
    }
}
