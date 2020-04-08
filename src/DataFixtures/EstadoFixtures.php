<?php

namespace App\DataFixtures;

use App\Entity\Estado;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EstadoFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $estados=[
              ['nombre'=>'Aguascalientes','clave'=>'0'],
              ['nombre'=>'Baja California','clave'=>'1'],
              ['nombre'=>'Baja California Sur','clave'=>'2'],
              ['nombre'=>'Campeche','clave'=>'3'],
              ['nombre'=>'Chiapas','clave'=>'4'],
              ['nombre'=>'Chihuahua','clave'=>'5'],
              ['nombre'=>'Coahuila','clave'=>'6'],
              ['nombre'=>'Colima','clave'=>'7'],
              ['nombre'=>'Ciudad de México','clave'=>'8'],
              ['nombre'=>'Durango','clave'=>'9'],
              ['nombre'=>'Estado de México','clave'=>'10'],
              ['nombre'=>'Guanajuato','clave'=>'11'],
              ['nombre'=>'Guerrero','clave'=>'12'],
              ['nombre'=>'Hidalgo','clave'=>'13'],
              ['nombre'=>'Jalisco','clave'=>'14'],
              ['nombre'=>'Michoacán','clave'=>'15'],
              ['nombre'=>'Morelos','clave'=>'16'],
              ['nombre'=>'Nayarit','clave'=>'17'],
              ['nombre'=>'Nuevo León','clave'=>'18'],
              ['nombre'=>'Oaxaca','clave'=>'19'],
              ['nombre'=>'Puebla','clave'=>'20'],
              ['nombre'=>'Querétaro','clave'=>'21'],
              ['nombre'=>'Quintana Roo','clave'=>'22'],
              ['nombre'=>'San Luis Potosí','clave'=>'23'],
              ['nombre'=>'Sinaloa','clave'=>'24'],
              ['nombre'=>'Sonora','clave'=>'25'],
              ['nombre'=>'Tabasco','clave'=>'26'],
              ['nombre'=>'Tamaulipas','clave'=>'27'],
              ['nombre'=>'Tlaxcala','clave'=>'28'],
              ['nombre'=>'Veracruz','clave'=>'29'],
              ['nombre'=>'Yucatán','clave'=>'30'],
              ['nombre'=>'Zacatecas','clave'=>'31']
        ];

        foreach ($estados as $obj) {
            $estado=new Estado();
            $estado->setNombre($obj['nombre']);
            $estado->setClave($obj['clave']);
            $manager->persist($estado);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 0;
    }
}
