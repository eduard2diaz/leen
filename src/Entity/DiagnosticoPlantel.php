<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiagnosticoPlantelRepository")
 */
class DiagnosticoPlantel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proyecto")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proyecto;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Range(
     *      min = 0,
     * )
     */
    private $numeroaulas;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionesAula;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Range(
     *      min = 0,
     * )
     */
    private $numerosanitarios;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionessanitarios;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Range(
     *      min = 0,
     * )
     */
    private $numerooficinas;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionoficina;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Range(
     *      min = 0,
     * )
     */
    private $numerobibliotecas;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionesbliblioteca;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Range(
     *      min = 0,
     * )
     */
    private $numeroaulasmedios;


    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionaulamedios;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Range(
     *      min = 0,
     * )
     */
    private $numeropatio;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionpatio;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Range(
     *      min = 0,
     * )
     */
    private $numerocanchasdeportivas;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicioncanchasdeportivas;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Range(
     *      min = 0,
     * )
     */
    private $numerobarda;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionbarda;

    /**
     * @ORM\Column(type="boolean")
     */
    private $aguapotable;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionagua;

    /**
     * @ORM\Column(type="boolean")
     */
    private $drenaje;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondiciondrenaje;

    /**
     * @ORM\Column(type="boolean")
     */
    private $energiaelectrica;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionenergia;

    /**
     * @ORM\Column(type="boolean")
     */
    private $telefono;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondiciontelefono;

    /**
     * @ORM\Column(type="boolean")
     */
    private $internet;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicioninternet;

    /**
     * @ORM\Column(type="integer")
     */
    private $iddiagnosticoplantel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $diagnosticoarchivo;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_num_aulas;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_num_sanitarios;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_num_oficinas;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_num_bibliotecas;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_num_aulamedios;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_num_patios;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_num_canchas_deportivas;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_num_bardas;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_agua_potables;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_drenaje;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_energiaelectrica;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_telefonia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descrip_internet;


    /**
     * @Assert\File(
     * maxSize="20mi",
     * notReadableMessage = "No se puede leer el archivo",
     * maxSizeMessage = "El archivo es demasiado grande. El tamaño máximo permitido es 20Mb",
     * uploadIniSizeErrorMessage = "El archivo es demasiado grande. El tamaño máximo permitido es 20Mb",
     * uploadFormSizeErrorMessage = "El archivo es demasiado grande. El tamaño máximo permitido es 20Mb",
     * uploadErrorMessage = "No se puede subir el archivo")
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProyecto(): ?Proyecto
    {
        return $this->proyecto;
    }

    public function setProyecto(?Proyecto $proyecto): self
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    public function getNumeroaulas(): ?int
    {
        return $this->numeroaulas;
    }

    public function setNumeroaulas(int $numeroaulas): self
    {
        $this->numeroaulas = $numeroaulas;

        return $this;
    }

    public function getIdcondicionesAula(): ?int
    {
        return $this->idcondicionesAula;
    }

    public function setIdcondicionesAula(int $idcondicionesAula): self
    {
        $this->idcondicionesAula = $idcondicionesAula;

        return $this;
    }

    public function getNumerosanitarios(): ?int
    {
        return $this->numerosanitarios;
    }

    public function setNumerosanitarios(int $numerosanitarios): self
    {
        $this->numerosanitarios = $numerosanitarios;

        return $this;
    }

    public function getIdcondicionessanitarios(): ?int
    {
        return $this->idcondicionessanitarios;
    }

    public function setIdcondicionessanitarios(int $idcondicionessanitarios): self
    {
        $this->idcondicionessanitarios = $idcondicionessanitarios;

        return $this;
    }

    public function getNumerooficinas(): ?int
    {
        return $this->numerooficinas;
    }

    public function setNumerooficinas(int $numerooficinas): self
    {
        $this->numerooficinas = $numerooficinas;

        return $this;
    }

    public function getIdcondicionoficina(): ?int
    {
        return $this->idcondicionoficina;
    }

    public function setIdcondicionoficina(int $idcondicionoficina): self
    {
        $this->idcondicionoficina = $idcondicionoficina;

        return $this;
    }

    public function getNumerobibliotecas(): ?int
    {
        return $this->numerobibliotecas;
    }

    public function setNumerobibliotecas(int $numerobibliotecas): self
    {
        $this->numerobibliotecas = $numerobibliotecas;

        return $this;
    }

    public function getIdcondicionesbliblioteca(): ?int
    {
        return $this->idcondicionesbliblioteca;
    }

    public function setIdcondicionesbliblioteca(int $idcondicionesbliblioteca): self
    {
        $this->idcondicionesbliblioteca = $idcondicionesbliblioteca;

        return $this;
    }

    public function getNumeroaulasmedios(): ?int
    {
        return $this->numeroaulasmedios;
    }

    public function setNumeroaulasmedios(int $numeroaulasmedios): self
    {
        $this->numeroaulasmedios = $numeroaulasmedios;

        return $this;
    }

    public function getIdcondicionaulamedios(): ?int
    {
        return $this->idcondicionaulamedios;
    }

    public function setIdcondicionaulamedios(int $idcondicionaulamedios): self
    {
        $this->idcondicionaulamedios = $idcondicionaulamedios;

        return $this;
    }

    public function getNumeropatio(): ?int
    {
        return $this->numeropatio;
    }

    public function setNumeropatio(int $numeropatio): self
    {
        $this->numeropatio = $numeropatio;

        return $this;
    }

    public function getIdcondicionpatio(): ?int
    {
        return $this->idcondicionpatio;
    }

    public function setIdcondicionpatio(int $idcondicionpatio): self
    {
        $this->idcondicionpatio = $idcondicionpatio;

        return $this;
    }

    public function getNumerocanchasdeportivas(): ?int
    {
        return $this->numerocanchasdeportivas;
    }

    public function setNumerocanchasdeportivas(int $numerocanchasdeportivas): self
    {
        $this->numerocanchasdeportivas = $numerocanchasdeportivas;

        return $this;
    }

    public function getIdcondicioncanchasdeportivas(): ?int
    {
        return $this->idcondicioncanchasdeportivas;
    }

    public function setIdcondicioncanchasdeportivas(int $idcondicioncanchasdeportivas): self
    {
        $this->idcondicioncanchasdeportivas = $idcondicioncanchasdeportivas;

        return $this;
    }

    public function getNumerobarda(): ?int
    {
        return $this->numerobarda;
    }

    public function setNumerobarda(int $numerobarda): self
    {
        $this->numerobarda = $numerobarda;

        return $this;
    }

    public function getIdcondicionbarda(): ?int
    {
        return $this->idcondicionbarda;
    }

    public function setIdcondicionbarda(int $idcondicionbarda): self
    {
        $this->idcondicionbarda = $idcondicionbarda;

        return $this;
    }

    public function getAguapotable(): ?bool
    {
        return $this->aguapotable;
    }

    public function setAguapotable(bool $aguapotable): self
    {
        $this->aguapotable = $aguapotable;

        return $this;
    }

    public function getIdcondicionagua(): ?int
    {
        return $this->idcondicionagua;
    }

    public function setIdcondicionagua(int $idcondicionagua): self
    {
        $this->idcondicionagua = $idcondicionagua;

        return $this;
    }

    public function getDrenaje(): ?bool
    {
        return $this->drenaje;
    }

    public function setDrenaje(bool $drenaje): self
    {
        $this->drenaje = $drenaje;

        return $this;
    }

    public function getIdcondiciondrenaje(): ?int
    {
        return $this->idcondiciondrenaje;
    }

    public function setIdcondiciondrenaje(int $idcondiciondrenaje): self
    {
        $this->idcondiciondrenaje = $idcondiciondrenaje;

        return $this;
    }

    public function getEnergiaelectrica(): ?bool
    {
        return $this->energiaelectrica;
    }

    public function setEnergiaelectrica(bool $energiaelectrica): self
    {
        $this->energiaelectrica = $energiaelectrica;

        return $this;
    }

    public function getIdcondicionenergia(): ?int
    {
        return $this->idcondicionenergia;
    }

    public function setIdcondicionenergia(int $idcondicionenergia): self
    {
        $this->idcondicionenergia = $idcondicionenergia;

        return $this;
    }

    public function getTelefono(): ?bool
    {
        return $this->telefono;
    }

    public function setTelefono(bool $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getIdcondiciontelefono(): ?int
    {
        return $this->idcondiciontelefono;
    }

    public function setIdcondiciontelefono(int $idcondiciontelefono): self
    {
        $this->idcondiciontelefono = $idcondiciontelefono;

        return $this;
    }

    public function getInternet(): ?bool
    {
        return $this->internet;
    }

    public function setInternet(bool $internet): self
    {
        $this->internet = $internet;

        return $this;
    }

    public function getIdcondicioninternet(): ?int
    {
        return $this->idcondicioninternet;
    }

    public function setIdcondicioninternet(int $idcondicioninternet): self
    {
        $this->idcondicioninternet = $idcondicioninternet;

        return $this;
    }

    public function getIddiagnosticoplantel(): ?int
    {
        return $this->iddiagnosticoplantel;
    }

    public function setIddiagnosticoplantel(int $iddiagnosticoplantel): self
    {
        $this->iddiagnosticoplantel = $iddiagnosticoplantel;

        return $this;
    }

    public function getDiagnosticoarchivo(): ?string
    {
        return $this->diagnosticoarchivo;
    }

    public function setDiagnosticoarchivo(string $diagnosticoarchivo): self
    {
        $this->diagnosticoarchivo = $diagnosticoarchivo;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getDescripNumAulas(): ?string
    {
        return $this->descrip_num_aulas;
    }

    public function setDescripNumAulas(?string $descrip_num_aulas): self
    {
        $this->descrip_num_aulas = $descrip_num_aulas;

        return $this;
    }

    public function getDescripNumSanitarios(): ?string
    {
        return $this->descrip_num_sanitarios;
    }

    public function setDescripNumSanitarios(?string $descrip_num_sanitarios): self
    {
        $this->descrip_num_sanitarios = $descrip_num_sanitarios;

        return $this;
    }

    public function getDescripNumOficinas(): ?string
    {
        return $this->descrip_num_oficinas;
    }

    public function setDescripNumOficinas(?string $descrip_num_oficinas): self
    {
        $this->descrip_num_oficinas = $descrip_num_oficinas;

        return $this;
    }

    public function getDescripNumBibliotecas(): ?string
    {
        return $this->descrip_num_bibliotecas;
    }

    public function setDescripNumBibliotecas(?string $descrip_num_bibliotecas): self
    {
        $this->descrip_num_bibliotecas = $descrip_num_bibliotecas;

        return $this;
    }

    public function getDescripNumAulamedios(): ?string
    {
        return $this->descrip_num_aulamedios;
    }

    public function setDescripNumAulamedios(?string $descrip_num_aulamedios): self
    {
        $this->descrip_num_aulamedios = $descrip_num_aulamedios;

        return $this;
    }

    public function getDescripNumPatios(): ?string
    {
        return $this->descrip_num_patios;
    }

    public function setDescripNumPatios(?string $descrip_num_patios): self
    {
        $this->descrip_num_patios = $descrip_num_patios;

        return $this;
    }

    public function getDescripNumCanchasDeportivas(): ?string
    {
        return $this->descrip_num_canchas_deportivas;
    }

    public function setDescripNumCanchasDeportivas(?string $descrip_num_canchas_deportivas): self
    {
        $this->descrip_num_canchas_deportivas = $descrip_num_canchas_deportivas;

        return $this;
    }

    public function getDescripNumBardas(): ?string
    {
        return $this->descrip_num_bardas;
    }

    public function setDescripNumBardas(?string $descrip_num_bardas): self
    {
        $this->descrip_num_bardas = $descrip_num_bardas;

        return $this;
    }

    public function getDescripAguaPotables(): ?string
    {
        return $this->descrip_agua_potables;
    }

    public function setDescripAguaPotables(?string $descrip_aula_potables): self
    {
        $this->descrip_agua_potables = $descrip_aula_potables;

        return $this;
    }


    public function getDescripDrenaje(): ?string
    {
        return $this->descrip_drenaje;
    }

    public function setDescripDrenaje(?string $descrip_drenaje): self
    {
        $this->descrip_drenaje = $descrip_drenaje;

        return $this;
    }

    public function getDescripEnergiaelectrica(): ?string
    {
        return $this->descrip_energiaelectrica;
    }

    public function setDescripEnergiaelectrica(?string $descrip_energiaelectrica): self
    {
        $this->descrip_energiaelectrica = $descrip_energiaelectrica;

        return $this;
    }

    public function getDescripTelefonia(): ?string
    {
        return $this->descrip_telefonia;
    }

    public function setDescripTelefonia(?string $descrip_telefonia): self
    {
        $this->descrip_telefonia = $descrip_telefonia;

        return $this;
    }

    public function getDescripInternet(): ?string
    {
        return $this->descrip_internet;
    }

    public function setDescripInternet(?string $descrip_internet): self
    {
        $this->descrip_internet = $descrip_internet;

        return $this;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(?UploadedFile $file) {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

}
