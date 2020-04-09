<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

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
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $montoasignado;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $montogastado;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $saldofinal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estatus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estatus;

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

    public function __toString()
    {
        return $this->getNumero();
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (null==$this->getEscuela())
            $context->addViolation('Seleccione una escuela.');
        if ($this->getFechainicio()>$this->getFechafin())
            $context->addViolation('Compruebe las fechas de inicio y fin.');
        if ($this->getMontoasignado()<$this->getMontogastado())
            $context->addViolation('Compruebe los montos asignados y gastados.');
        elseif ($this->getMontoasignado()-$this->getMontogastado()!=$this->getSaldofinal())
            $context->addViolation('El saldo final no concuerda con los montos asignados y gastados.');
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEstatus(): ?Estatus
    {
        return $this->estatus;
    }

    public function setEstatus(?Estatus $estatus): self
    {
        $this->estatus = $estatus;

        return $this;
    }
}
