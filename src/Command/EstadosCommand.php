<?php

namespace App\Command;

use App\Entity\Ciudad;
use App\Entity\CodigoPostal;
use App\Entity\Estado;
use App\Entity\Municipio;
use App\Entity\TipoAsentamiento;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

class EstadosCommand extends Command
{
    protected static $defaultName = 'import:estados';

    protected $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('COMANDO QUE IMPORTA LOS DATOS DEL CSV DE CODIGOS POSTALES');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $reader = Reader::createFromPath('%kernel.root_dir%/../src/Data/codigopostal.csv');
        $header=['indice','descripcion_asentamiento','tipo_asentamiento','nombre_municipio','nombre_estado',
            'nombre_ciudad','codigo_postal','codigo_estado','codigo_oficina','ccp','codigo_tipo_asentamiento',
            'codigo_municipio','id_asenta_cpcons','descripcion_zona','unknown2','clave_ciudad'
            ];
        $records = $reader->getRecords($header);
        $i = 0;
        $descripcionAsentamientoString = "";
        $tipoAsentamientoString = "";
        $tipoAsentamientoCodigoString = "";
        $municipioString = "";
        $estadoString = "";
        $dCPString="";
        $cod_oficinaString="";
        $ciudadString = "";
        $ciudadCodeString = "";
        $estadoCodigoString = "";
        $descripcionZonaString = "";
        $tipo_asentamientoCodigoString = "";
        $municipioCodigoString = "";
        $estadoObject = null;
        $municipioObject = null;
        $tipoAsentamientoObject = null;
        $idAsentamientoPCons="";
        $ccp="";
        $ciudadObject = null;
        $count=$reader->count();
        
        $progressBar = new ProgressBar($output, $count);

        foreach ($records as $data) {
            //$io->success("Fila ".($i+1)."/".$count);
            if ($i != 0) {
                //Obteniendo los datos
                $descripcionAcentamientoString = $data['descripcion_asentamiento'];
                $tipoAsentamientoString = $data['tipo_asentamiento'];
                $tipoAsentamientoCodigoString=$data['codigo_tipo_asentamiento'];
                $municipioString = $data['nombre_municipio'];
                $estadoString = $data['nombre_estado'];
                $ciudadString = $data['nombre_ciudad'];
                $ciudadCodeString=$data['clave_ciudad'];
                $codigo_postalString = $data['codigo_postal'];
                $estadoCodigoString = $data['codigo_estado'];
                $cod_oficinaString=$data['codigo_oficina'];
                $tipo_asentamientoCodigoString = $data['codigo_tipo_asentamiento'];
                $municipioCodigoString = $data['codigo_municipio'];
                $descripcionZonaString = $data['descripcion_zona'];
                $idAsentamientoPCons = $data['id_asenta_cpcons'];
                $ccp=$data['ccp'];

                $estadoObject = $this->manager->getRepository(Estado::class)->findOneByNombre($estadoString);
                if (!$estadoObject) {
                    $estadoObject = new Estado();
                    $estadoObject->setNombre($estadoString);
                    $estadoObject->setClave($estadoCodigoString);
                    $this->manager->persist($estadoObject);
                    $this->manager->flush();
                }

                $municipioObject = $this->manager->getRepository(Municipio::class)->findOneBy(
                    [
                     'nombre'=> $municipioString,
                     'estado'=> $estadoObject
                    ]);
                if (!$municipioObject) {
                    $municipioObject = new Municipio();
                    $municipioObject->setNombre($municipioString);
                    $municipioObject->setClave($municipioCodigoString);
                    $municipioObject->setEstado($estadoObject);
                    $this->manager->persist($municipioObject);
                    $this->manager->flush();
                }


                $tipoAsentamientoObject = $this->manager->getRepository(TipoAsentamiento::class)
                                        ->findOneByNombre($tipoAsentamientoString);

                if (!$tipoAsentamientoObject) {
                    $tipoAsentamientoObject = new TipoAsentamiento();
                    $tipoAsentamientoObject->setNombre($tipoAsentamientoString);
                    $tipoAsentamientoObject->setClave($tipo_asentamientoCodigoString);
                    $this->manager->persist($tipoAsentamientoObject);
                    $this->manager->flush();
                }

                if ($ciudadString!='NULL'){
                    $ciudadObject = $this->manager->getRepository(Ciudad::class)
                        ->findOneBy(
                            ['nombre'=>$ciudadString,
                             'estado'=>$estadoObject,
                             'municipio'=>$municipioObject
                            ]
                        );

                    if (!$ciudadObject) {
                        $ciudadObject = new Ciudad();
                        $ciudadObject->setNombre($ciudadString);
                        $ciudadObject->setEstado($estadoObject);
                        $ciudadObject->setMunicipio($municipioObject);
                        $ciudadObject->setClave($ciudadCodeString);
                        $this->manager->persist($ciudadObject);
                        $this->manager->flush();
                    }
                }
                else
                    $ciudadObject=null;

                $codigoPostal=new CodigoPostal();
                $codigoPostal->setMunicipio($municipioObject);
                $codigoPostal->setEstado($estadoObject);
                $codigoPostal->setCiudad($ciudadObject);
                $codigoPostal->setDAsenta($descripcionAsentamientoString);
                $codigoPostal->setDZona($descripcionZonaString);
                $codigoPostal->setTipoasentamiento($tipoAsentamientoObject);
                $codigoPostal->setIdAsentaCpcons($idAsentamientoPCons);
                $codigoPostal->setDCp($codigo_postalString);
                $this->manager->persist($codigoPostal);

            }
            $i++;

            $progressBar->advance();
        }
        $this->manager->flush();
        $progressBar->finish();

        return 0;
    }

}
