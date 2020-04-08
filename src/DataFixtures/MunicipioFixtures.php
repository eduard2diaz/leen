<?php

namespace App\DataFixtures;

use App\Entity\Estado;
use App\Entity\Municipio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MunicipioFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $estados=[
              ['estado'=>'Aguascalientes'],
              ['estado'=>'Baja California'],
              ['estado'=>'Baja California Sur'],
              ['estado'=>'Campeche'],
              ['estado'=>'Chiapas'],
              ['estado'=>'Chihuahua'],
              ['estado'=>'Coahuila'],
              ['estado'=>'Colima'],
              ['estado'=>'Ciudad de México',
                  'municipios'=>[
                      ['municipio'=>'Tlalpan','clave'=>'012'],
                      ['municipio'=>'Venustiano Carranza','clave'=>'017'],
                      ['municipio'=>'Azcapotzalco','clave'=>'002'],
                      ['municipio'=>'Iztapalapa','clave'=>'007'],
                      ['municipio'=>'Iztacalco','clave'=>'006'],
                      ['municipio'=>'Miguel Hidalgo','clave'=>'016'],
                      ['municipio'=>'La Magdalena Contreras','clave'=>'008'],
                      ['municipio'=>'Coyoacán','clave'=>'003'],
                      ['municipio'=>'Milpa Alta','clave'=>'009'],
                      ['municipio'=>'Tláhuac','clave'=>'011'],
                      ['municipio'=>'Benito Juárez','clave'=>'014'],
                      ['municipio'=>'Cuajimalpa de Morelos','clave'=>'004'],
                      ['municipio'=>'Gustavo A. Madero','clave'=>'005'],
                      ['municipio'=>'Cuauhtémoc','clave'=>'015'],
                      ['municipio'=>'Álvaro Obregón','clave'=>'010'],
                      ['municipio'=>'Xochimilco','clave'=>'013'],
                  ]
              ],
              ['estado'=>'Durango'],
              ['estado'=>'Estado de México'],
              ['estado'=>'Guanajuato'],
              ['estado'=>'Guerrero'],
              ['estado'=>'Hidalgo'],
              ['estado'=>'Jalisco'],
              ['estado'=>'Michoacán'],
              ['estado'=>'Morelos'],
              ['estado'=>'Nayarit'],
              ['estado'=>'Nuevo León'],
              ['estado'=>'Oaxaca'],
              ['estado'=>'Puebla'],
              ['estado'=>'Querétaro'],
              ['estado'=>'Quintana Roo'],
              ['estado'=>'San Luis Potosí'],
              ['estado'=>'Sinaloa'],
              ['estado'=>'Sonora'],
              ['estado'=>'Tabasco'],
              ['estado'=>'Tamaulipas'],
              ['estado'=>'Tlaxcala'],
              ['estado'=>'Veracruz'],
              ['estado'=>'Yucatán'],
              ['estado'=>'Zacatecas']
        ];

        foreach ($estados as $estadoObj) {
            $estado = $manager->getRepository(Estado::class)->findOneByNombre($estadoObj['estado']);
            if(!$estado)
                continue;
            if (array_key_exists('municipios', $estadoObj)) {
                foreach ($estadoObj['municipios'] as $municipioObj) {
                    $municipio = new Municipio();
                    $municipio->setNombre($municipioObj['municipio']);
                    $municipio->setClave($municipioObj['clave']);
                    $municipio->setEstado($estado);
                    $manager->persist($municipio);
                }
            }
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 1;
    }
}
