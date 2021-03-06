<?php

namespace App\EventSubscriber;

use App\Entity\DiagnosticoPlantel;
use App\Entity\PlanTrabajo;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Tool\FileStorageManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class PlanTrabajoSubscriber  implements EventSubscriber
{
    private $serviceContainer;

    function __construct(ContainerInterface $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    /**
     * @return mixed
     */
    public function getServiceContainer()
    {
        return $this->serviceContainer;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof PlanTrabajo) {

            $ruta=$this->getServiceContainer()->getParameter('storage_directory');
            $file=$entity->getFile();
            $nombreArchivo=FileStorageManager::Upload($ruta,$file);
            if (null!=$nombreArchivo)
                $entity->setPlanarchivo($nombreArchivo);
        }
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof PlanTrabajo) {
            $directory = $this->getServiceContainer()->getParameter('storage_directory');
            $ruta=$directory . DIRECTORY_SEPARATOR . $entity->getPlanarchivo();
            FileStorageManager::removeUpload($ruta);
        }
    }


    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preRemove'
        ];
    }
}
