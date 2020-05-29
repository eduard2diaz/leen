<?php

namespace App\Repository;

use App\Entity\Municipio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Municipio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Municipio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Municipio[]    findAll()
 * @method Municipio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MunicipioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Municipio::class);
    }

    public function findByEstadoJson($estado)
    {
        $consulta="Select array_to_json(array_agg(data)) from (Select m.id as id, m.nombre as nombre from municipio as m join estado e on m.estado_id = e.id WHERE e.id=".$estado.") as data";
        $connection=$this->getEntityManager()->getConnection();
        $statement=$connection->query($consulta);
        $result = $statement->fetchAll();
        return $result[0]['array_to_json'];
    }

}
