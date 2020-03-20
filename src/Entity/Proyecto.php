<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProyectoRepository")
 */
class Proyecto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escuela")
     * @ORM\JoinColumn(nullable=false)
     */
    private $escuela;

    /**
     * @ORM\Column(type="date")
     */
    private $fechainicio;

    /**
     * @ORM\Column(type="date")
     */
    private $fechafin;

    /**
     * @ORM\Column(type="float")
     */
    private $montoasignado;

    /**
     * @ORM\Column(type="float")
     */
    private $montogastado;

    /**
     * @ORM\Column(type="float")
     */
    private $saldofinal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEscuela(): ?Escuela
    {
        return $this->escuela;
    }

    public function setEscuela(?Escuela $escuela): self
    {
        $this->escuela = $escuela;

        return $this;
    }

    public function getFechainicio(): ?\DateTimeInterface
    {
        return $this->fechainicio;
    }

    public function setFechainicio(\DateTimeInterface $fechainicio): self
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    public function getFechafin(): ?\DateTimeInterface
    {
        return $this->fechafin;
    }

    public function setFechafin(\DateTimeInterface $fechafin): self
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    public function getMontoasignado(): ?float
    {
        return $this->montoasignado;
    }

    public function setMontoasignado(float $montoasignado): self
    {
        $this->montoasignado = $montoasignado;

        return $this;
    }

    public function getMontogastado(): ?float
    {
        return $this->montogastado;
    }

    public function setMontogastado(float $montogastado): self
    {
        $this->montogastado = $montogastado;

        return $this;
    }

    public function getSaldofinal(): ?float
    {
        return $this->saldofinal;
    }

    public function setSaldofinal(float $saldofinal): self
    {
        $this->saldofinal = $saldofinal;

        return $this;
    }
}
