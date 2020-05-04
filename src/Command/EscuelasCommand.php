<?php

namespace App\Command;

use App\Entity\Ciudad;
use App\Entity\CodigoPostal;
use App\Entity\Escuela;
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

class EscuelasCommand extends Command
{
    protected static $defaultName = 'import:escuelas';

    protected $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('COMANDO QUE IMPORTA LOS DATOS DEL CSV DE ESCUELAS');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $reader = Reader::createFromPath('%kernel.root_dir%/../src/Data/escuelas.csv');
        $header=['indice','idplantel','ccts','escuela','idcodigo','cv_cct'];
        $records = $reader->getRecords($header);
        $i = 0;
        $ccts = "";
        $nombre = "";
        $codigo = "";
        $codigo = "";
        $plantel = "";

        $count=$reader->count();
        $progressBar = new ProgressBar($output, $count);

        foreach ($records as $data) {
            if ($i != 0) {
                //Obteniendo los datos
                $plantel = $data['idplantel'];
                $ccts = $data['ccts'];
                $nombre = $data['escuela'];
                $codigo = $data['idcodigo'];
                $codigopostal=null;
                if($codigo!=null)
                $codigopostal = $this->manager->getRepository(CodigoPostal::class)
                                              ->findOneBy(['d_cp' => $codigo]);

                $escuela = new Escuela();
                $escuela->setEscuela($nombre);
                $escuela->setCcts($ccts);
                $escuela->setDCodigo($codigopostal);
                $this->manager->persist($escuela);


            }
            $progressBar->advance();
            $i++;
        }
        $this->manager->flush();
        $progressBar->finish();

        return 0;
    }

}
