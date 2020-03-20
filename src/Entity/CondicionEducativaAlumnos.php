<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CondicionEducativaAlumnosRepository")
 */
class CondicionEducativaAlumnos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DiagnosticoPlantel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diagnostico;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $ccts;

    /**
     * @ORM\Column(type="integer")
     */
    private $numalumnas;

    /**
     * @ORM\Column(type="integer")
     */
    private $numalumnos;

    /**
     * @ORM\Column(type="integer")
     */
    private $grado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiagnostico(): ?DiagnosticoPlantel
    {
        return $this->diagnostico;
    }

    public function setDiagnostico(?DiagnosticoPlantel $diagnostico): self
    {
        $this->diagnostico = $diagnostico;

        return $this;
    }

    public function getCcts(): ?string
    {
        return $this->ccts;
    }

    public function setCcts(string $ccts): self
    {
        $this->ccts = $ccts;

        return $this;
    }

    public function getNumalumnas(): ?int
    {
        return $this->numalumnas;
    }

    public function setNumalumnas(int $numalumnas): self
    {
        $this->numalumnas = $numalumnas;

        return $this;
    }

    public function getNumalumnos(): ?int
    {
        return $this->numalumnos;
    }

    public function setNumalumnos(int $numalumnos): self
    {
        $this->numalumnos = $numalumnos;

        return $this;
    }

    public function getGrado(): ?int
    {
        return $this->grado;
    }

    public function setGrado(int $grado): self
    {
        $this->grado = $grado;

        return $this;
    }
}
