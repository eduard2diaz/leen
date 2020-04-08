<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $numeroaulas;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionesAula;

    /**
     * @ORM\Column(type="integer")
     */
    private $numerosanitarios;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionessanitarios;

    /**
     * @ORM\Column(type="integer")
     */
    private $numerooficinas;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionoficina;

    /**
     * @ORM\Column(type="integer")
     */
    private $numerobibliotecas;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionesbliblioteca;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroaulasmedios;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionaulamedios;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeropatio;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicionpatio;

    /**
     * @ORM\Column(type="integer")
     */
    private $numerocanchasdeportivas;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcondicioncanchasdeportivas;

    /**
     * @ORM\Column(type="integer")
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
}
