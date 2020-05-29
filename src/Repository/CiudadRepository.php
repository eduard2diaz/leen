<?php

namespace App\Repository;

use App\Entity\Ciudad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ciudad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ciudad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ciudad[]    findAll()
 * @method Ciudad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiudadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ciudad::class);
    }

    public function findByMunicipioJson($municipio)
    {
        $consulta="Select array_to_json(array_agg(data)) from (Select c.id as id, c.nombre as nombre from ciudad as c join municipio m on c.municipio_id = m.id WHERE m.id=".$municipio.") as data";
        $connection=$this->getEntityManager()->getConnection();
        $statement=$connection->query($consulta);
        $result = $statement->fetchAll();
        return $result[0]['array_to_json'];
    }
}
