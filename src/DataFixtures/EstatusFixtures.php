<?php

namespace App\DataFixtures;

use App\Entity\Estatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EstatusFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $estados=['Activo','Inactivo','Cancelado','Eliminado'];
        foreach ($estados as $estado){
            $value=new Estatus();
            $value->setEstatus($estado);
            $manager->persist($value);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }


}
