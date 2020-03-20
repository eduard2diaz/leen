<?php

namespace App\DataFixtures;

use App\Entity\Alcaldia;
use App\Entity\Colonia;
use App\Entity\Estado;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class PaisFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $pais=[
                ['estado'=>'Aguascalientes','identificador'=>'Pendiente'],
                ['estado'=>'Baja California','identificador'=>'Pendiente'],
                ['estado'=>'Baja California Sur','identificador'=>'Pendiente'],
                ['estado'=>'Campeche','identificador'=>'Pendiente'],
                ['estado'=>'Chiapas','identificador'=>'Pendiente'],
                ['estado'=>'Chihuahua','identificador'=>'Pendiente'],
                ['estado'=>'Coahuila','identificador'=>'Pendiente'],
                ['estado'=>'Colima','identificador'=>'Pendiente'],
                ['estado'=>'Ciudad de México','identificador'=>'09',
                    'alcaldias'=>[
                        ['alcaldia'=>'Tlalpan','identificador'=>'012'],
                        ['alcaldia'=>'Venustiano Carranza','identificador'=>'017'],
                        ['alcaldia'=>'Azcapotzalco','identificador'=>'002'],
                        ['alcaldia'=>'Iztapalapa','identificador'=>'007'],
                        ['alcaldia'=>'Iztacalco','identificador'=>'006'],
                        ['alcaldia'=>'Miguel Hidalgo','identificador'=>'016'],
                        ['alcaldia'=>'La Magdalena Contreras','identificador'=>'008'],
                        ['alcaldia'=>'Coyoacán','identificador'=>'003'],
                        ['alcaldia'=>'Milpa Alta','identificador'=>'009'],
                        ['alcaldia'=>'Tláhuac','identificador'=>'011'],
                        ['alcaldia'=>'Benito Juárez','identificador'=>'014'],
                        ['alcaldia'=>'Cuajimalpa de Morelos','identificador'=>'004'],
                        ['alcaldia'=>'Gustavo A. Madero','identificador'=>'005',
                         'colonias'=>[
                             'CASAS ALEMAN (AMPL) I','CASAS ALEMAN (AMPL) II','AHUEHUETES','SAN ANTONIO',
                             '15 DE AGOSTO','FERNANDO CASAS ALEMAN','PROVIDENCIA (AMPL)','CUAUTEPEC EL ALTO (PBLO)',
                              'TABLAS DE SAN AGUSTIN'
                         ]
                        ],
                        ['alcaldia'=>'Cuauhtémoc','identificador'=>'015'],
                        ['alcaldia'=>'Álvaro Obregón','identificador'=>'010'],
                        ['alcaldia'=>'Xochimilco','identificador'=>'013'],
                    ]
                ],
                ['estado'=>'Durango','identificador'=>'Pendiente'],
                ['estado'=>'Estado de México','identificador'=>'Pendiente'],
                ['estado'=>'Guanajuato','identificador'=>'Pendiente'],
                ['estado'=>'Guerrero','identificador'=>'Pendiente'],
                ['estado'=>'Hidalgo','identificador'=>'Pendiente'],
                ['estado'=>'Jalisco','identificador'=>'Pendiente'],
                ['estado'=>'Michoacán','identificador'=>'Pendiente'],
                ['estado'=>'Morelos','identificador'=>'Pendiente'],
                ['estado'=>'Nayarit','identificador'=>'Pendiente'],
                ['estado'=>'Nuevo León','identificador'=>'Pendiente'],
                ['estado'=>'Oaxaca','identificador'=>'Pendiente'],
                ['estado'=>'Puebla','identificador'=>'Pendiente'],
                ['estado'=>'Querétaro','identificador'=>'Pendiente'],
                ['estado'=>'Quintana Roo','identificador'=>'Pendiente'],
                ['estado'=>'San Luis Potosí','identificador'=>'Pendiente'],
                ['estado'=>'Sinaloa','identificador'=>'Pendiente'],
                ['estado'=>'Sonora','identificador'=>'Pendiente'],
                ['estado'=>'Tabasco','identificador'=>'Pendiente'],
                ['estado'=>'Tamaulipas','identificador'=>'Pendiente'],
                ['estado'=>'Tlaxcala','identificador'=>'Pendiente'],
                ['estado'=>'Veracruz','identificador'=>'Pendiente'],
                ['estado'=>'Yucatán','identificador'=>'Pendiente'],
                ['estado'=>'Zacatecas','identificador'=>'Pendiente']
            ];

        foreach ($pais as $estadoObj) {
                    $estado = new Estado();
                    $estado->setNombre($estadoObj['estado']);
                    $estado->setIdentificador($estadoObj['identificador']);
                    $manager->persist($estado);
                    if (array_key_exists('alcaldias', $estadoObj)) {
                        foreach ($estadoObj['alcaldias'] as $alcaldiaObj) {
                            $alcaldia = new Alcaldia();
                            $alcaldia->setNombre($alcaldiaObj['alcaldia']);
                            $alcaldia->setIdentificador($alcaldiaObj['identificador']);
                            $alcaldia->setEstado($estado);
                            $manager->persist($alcaldia);
                            if (array_key_exists('colonias', $alcaldiaObj)) {
                                foreach ($alcaldiaObj['colonias'] as $coloniaObj) {
                                    $colonia = new Colonia();
                                    $colonia->setNombre($coloniaObj);
                                    $colonia->setEstado($estado);
                                    $colonia->setAlcaldia($alcaldia);
                                    $manager->persist($colonia);
                                }
                            }
                        }
                    }
        }
        $manager->flush();
    }

}
