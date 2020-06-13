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
        $estados=[
            ['nombre'=>'Activo','code'=>Estatus::ACTIVE_CODE],
            ['nombre'=>'Inactivo','code'=>Estatus::INACTIVE_CODE],
            ['nombre'=>'Cancelado','code'=>Estatus::CANCEL_CODE],
            ['nombre'=>'Eliminado','code'=>Estatus::DELETE_CODE],
        ];
        foreach ($estados as $estado){
            $value=new Estatus();
            $value->setEstatus($estado['nombre']);
            $value->setCode($estado['code']);
            $manager->persist($value);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }


}
