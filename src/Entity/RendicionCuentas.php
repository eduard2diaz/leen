<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RendicionCuentasRepository")
 */
class RendicionCuentas
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
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoAccion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipoAccion;

    /**
     * @ORM\Column(type="date")
     */
    private $fechacaptura;

    /**
     * @ORM\Column(type="float")
     */
    private $monto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rendicionesarchivos;

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

    public function getTipoAccion(): ?TipoAccion
    {
        return $this->tipoAccion;
    }

    public function setTipoAccion(?TipoAccion $tipoAccion): self
    {
        $this->tipoAccion = $tipoAccion;

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

    public function getMonto(): ?float
    {
        return $this->monto;
    }

    public function setMonto(float $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getRendicionesarchivos(): ?string
    {
        return $this->rendicionesarchivos;
    }

    public function setRendicionesarchivos(string $rendicionesarchivos): self
    {
        $this->rendicionesarchivos = $rendicionesarchivos;

        return $this;
    }
}
