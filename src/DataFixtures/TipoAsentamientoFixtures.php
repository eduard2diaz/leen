<?php

namespace App\DataFixtures;

use App\Entity\TipoAsentamiento;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TipoAsentamientoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tipoasentamientos=[
            ['nombre'=>'Aeropuerto','clave'=>1],
            ['nombre'=>'Barrio','clave'=>2],
            ['nombre'=>'Campamento','clave'=>3],
            ['nombre'=>'Colonia','clave'=>4],
            ['nombre'=>'Condominio','clave'=>5],
            ['nombre'=>'Ejido','clave'=>'Pendiente'],
            ['nombre'=>'Equipamiento','clave'=>6],
            ['nombre'=>'Ex hacienda','clave'=>7],
            ['nombre'=>'Fraccionamiento','clave'=>8],
            ['nombre'=>'Granja','clave'=>9],
            ['nombre'=>'Hacienda','clave'=>10],
            ['nombre'=>'Ingenio','clave'=>11],
            ['nombre'=>'Parque Industrial','clave'=>12],
            ['nombre'=>'Pueblo','clave'=>13],
            ['nombre'=>'Rancho o Ranchería','clave'=>14],
            ['nombre'=>'Unidad Habitacional','clave'=>15],
            ['nombre'=>'Zona Comercial','clave'=>16],
            ['nombre'=>'Zona Industrial','clave'=>17],
            ];

        foreach ($tipoasentamientos as $obj) {
            $tipoAsentamiento=new TipoAsentamiento();
            $tipoAsentamiento->setNombre($obj['nombre']);
            $tipoAsentamiento->setClave((integer)$obj['clave']);
            $manager->persist($tipoAsentamiento);
        }

        $manager->flush();
    }
}
