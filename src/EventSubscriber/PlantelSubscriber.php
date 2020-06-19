<?php

namespace App\EventSubscriber;

use App\Entity\Estatus;
use App\Entity\Plantel;
use App\Tool\FileStorageManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class PlantelSubscriber  implements EventSubscriber
{

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em=$args->getEntityManager();

        if($entity instanceof  Plantel){
            $connection=$em->getConnection();
            $this->tranformarCoordenada($connection,$entity->getId());
        }

    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em=$args->getEntityManager();

        if($entity instanceof  Plantel){
            $connection=$em->getConnection();
            $this->tranformarCoordenada($connection,$entity->getId());
        }

    }

    private function tranformarCoordenada($connection,$id){
        $consulta="
                UPDATE plantel SET coord_geometry=ST_GeomFromText('POINT('||longitud||' '||latitud||')', 3042) where id=".$id."
            ";
        $statement = $connection->query($consulta);
        $statement->execute();
    }


    public function getSubscribedEvents()
    {
        return [
            'postPersist',
            'postUpdate',
        ];
    }
}
