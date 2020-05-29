<?php

namespace App\Repository;

use App\Entity\CondicionEducativaAlumnos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CondicionEducativaAlumnos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CondicionEducativaAlumnos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CondicionEducativaAlumnos[]    findAll()
 * @method CondicionEducativaAlumnos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CondicionEducativaAlumnosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CondicionEducativaAlumnos::class);
    }

    public function findActivos($diagnostico)
    {
        return $this->createQueryBuilder('ce')
            ->join('ce.diagnostico','d')
            ->join('ce.estatus','es')
            ->andWhere('es.estatus = :val')
            ->andWhere('d.id = :diagnostico')
            ->setParameter('val', 'Activo')
            ->setParameter('diagnostico', $diagnostico)
            ->getQuery()
            ->getResult();
    }
}
