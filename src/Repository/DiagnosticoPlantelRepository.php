<?php

namespace App\Repository;

use App\Entity\DiagnosticoPlantel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DiagnosticoPlantel|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiagnosticoPlantel|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiagnosticoPlantel[]    findAll()
 * @method DiagnosticoPlantel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiagnosticoPlantelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiagnosticoPlantel::class);
    }

    public function findActivos($escuela)
    {
        return $this->createQueryBuilder('dp')
            ->join('dp.proyecto','p')
            ->join('p.escuela','e')
            ->join('dp.estatus','es')
            ->andWhere('es.estatus = :val')
            ->andWhere('e.id = :escuela')
            ->setParameter('val', 'Activo')
            ->setParameter('escuela', $escuela)
            ->getQuery()
            ->getResult();
    }

    public function findOneByTipoCondicion($tipo_condicion): ?DiagnosticoPlantel
    {
        $query= 'Select dp FROM App:DiagnosticoPlantel dp 
        WHERE 
        dp.idcondicionesAula=:id OR
        dp.idcondicionessanitarios=:id OR
        dp.idcondicionoficina=:id OR
        dp.idcondicionesbliblioteca=:id OR
        dp.idcondicionaulamedios=:id OR
        dp.idcondicionpatio=:id OR
        dp.idcondicioncanchasdeportivas=:id OR
        dp.idcondicionbarda=:id OR
        dp.idcondicionagua=:id OR
        dp.idcondiciondrenaje=:id OR
        dp.idcondicionenergia=:id OR
        dp.idcondiciontelefono=:id OR
        dp.idcondicioninternet=:id         
        ';

        $consulta = $this->getEntityManager()->createQuery($query)->setParameter('id', $tipo_condicion);
        return $consulta->getOneOrNullResult();
    }

}
