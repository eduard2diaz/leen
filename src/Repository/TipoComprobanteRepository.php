<?php

namespace App\Repository;

use App\Entity\TipoComprobante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoComprobante|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoComprobante|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoComprobante[]    findAll()
 * @method TipoComprobante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoComprobanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoComprobante::class);
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
