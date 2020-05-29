<?php

namespace App\Repository;

use App\Entity\CodigoPostal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CodigoPostal|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodigoPostal|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodigoPostal[]    findAll()
 * @method CodigoPostal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodigoPostalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodigoPostal::class);
    }

    public function findByMunicipioJson($municipio)
    {
        $consulta="Select array_to_json(array_agg(data)) from (Select cp.id as id, cp.d_cp as nombre from codigo_postal as cp join municipio m on m.id = cp.municipio_id WHERE m.id=".$municipio.") as data";
        $connection=$this->getEntityManager()->getConnection();
        $statement=$connection->query($consulta);
        $result = $statement->fetchAll();
        return $result[0]['array_to_json'];
    }
}
