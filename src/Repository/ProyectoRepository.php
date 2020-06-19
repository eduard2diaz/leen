<?php

namespace App\Repository;

use App\Entity\Proyecto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Proyecto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proyecto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proyecto[]    findAll()
 * @method Proyecto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProyectoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proyecto::class);
    }


    public function findSumaGastos($proyecto_id)
    {
        $cadena = "SELECT SUM(cg.monto) FROM App:ControlGastos cg JOIN cg.proyecto p WHERE p.id= :proyecto ";
        $consulta = $this->getEntityManager()->createQuery($cadena);
        $consulta->setParameter('proyecto', $proyecto_id);
        return $consulta->getResult()[0][1]==null ? 0 : $consulta->getResult()[0][1];
    }

}
