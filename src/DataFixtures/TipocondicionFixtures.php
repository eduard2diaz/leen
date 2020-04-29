<?php

namespace App\DataFixtures;

use App\Entity\TipoCondicion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TipocondicionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $estados=['Bueno','Malo','Regular'];
        foreach ($estados as $estado){
            $value=new TipoCondicion();
            $value->setCondicion($estado);
            $manager->persist($value);
        }
        $manager->flush();
    }
}
