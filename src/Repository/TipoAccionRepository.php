<?php

namespace App\Repository;

use App\Entity\TipoAccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoAccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoAccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoAccion[]    findAll()
 * @method TipoAccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoAccionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoAccion::class);
    }

    public function findActivos()
    {
        return $this->createQueryBuilder('t')
            ->join('t.estatus','e')
            ->andWhere('e.estatus = :val')
            ->setParameter('val', 'Activo')
            ->getQuery()
            ->getResult();
    }
}
