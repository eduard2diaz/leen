<?php

namespace App\Repository;

use App\Entity\CondicionDocenteEducativa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CondicionDocenteEducativa|null find($id, $lockMode = null, $lockVersion = null)
 * @method CondicionDocenteEducativa|null findOneBy(array $criteria, array $orderBy = null)
 * @method CondicionDocenteEducativa[]    findAll()
 * @method CondicionDocenteEducativa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CondicionDocenteEducativaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CondicionDocenteEducativa::class);
    }

    public function findActivos($diagnostico)
    {
        return $this->createQueryBuilder('cd')
            ->join('cd.diagnostico','d')
            ->join('cd.estatus','es')
            ->andWhere('es.estatus = :val')
            ->andWhere('d.id = :diagnostico')
            ->setParameter('val', 'Activo')
            ->setParameter('diagnostico', $diagnostico)
            ->getQuery()
            ->getResult();
    }
}
