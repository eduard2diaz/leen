<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ControlGastosRepository")
 */
class ControlGastos
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
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoComprobante")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipoComprobante;

    /**
     * @ORM\Column(type="date")
     */
    private $fechacaptura;

    /**
     * @ORM\Column(type="text")
     */
    private $concepto;

    /**
     * @ORM\Column(type="integer")
     */
    private $numerocomprobante;

    /**
     * @ORM\Column(type="float")
     */
    private $monto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $controlarchivos;

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

    public function getTipoComprobante(): ?TipoComprobante
    {
        return $this->tipoComprobante;
    }

    public function setTipoComprobante(?TipoComprobante $tipoComprobante): self
    {
        $this->tipoComprobante = $tipoComprobante;

        return $this;
    }

    public function getFechacaptura(): ?\DateTimeInterface
    {
        return $this->fechacaptura;
    }

    public function setFechacaptura(\DateTimeInterface $fechacaptura): self
    {
        $this->fechacaptura = $fechacaptura;

        return $this;
    }

    public function getConcepto(): ?string
    {
        return $this->concepto;
    }

    public function setConcepto(string $concepto): self
    {
        $this->concepto = $concepto;

        return $this;
    }

    public function getNumerocomprobante(): ?int
    {
        return $this->numerocomprobante;
    }

    public function setNumerocomprobante(int $numerocomprobante): self
    {
        $this->numerocomprobante = $numerocomprobante;

        return $this;
    }

    public function getMonto(): ?float
    {
        return $this->monto;
    }

    public function setMonto(float $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getControlarchivos(): ?string
    {
        return $this->controlarchivos;
    }

    public function setControlarchivos(string $controlarchivos): self
    {
        $this->controlarchivos = $controlarchivos;

        return $this;
    }
}
