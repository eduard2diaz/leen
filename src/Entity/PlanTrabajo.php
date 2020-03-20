<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlanTrabajoRepository")
 */
class PlanTrabajo
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
     * @ORM\Column(type="text")
     */
    private $descripcionaccion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tiempoestimado;

    /**
     * @ORM\Column(type="float")
     */
    private $costoestimado;

    /**
     * @ORM\Column(type="float")
     */
    private $totalrecursosasignados;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $planarchivo;

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

    public function getDescripcionaccion(): ?string
    {
        return $this->descripcionaccion;
    }

    public function setDescripcionaccion(string $descripcionaccion): self
    {
        $this->descripcionaccion = $descripcionaccion;

        return $this;
    }

    public function getTiempoestimado(): ?string
    {
        return $this->tiempoestimado;
    }

    public function setTiempoestimado(string $tiempoestimado): self
    {
        $this->tiempoestimado = $tiempoestimado;

        return $this;
    }

    public function getCostoestimado(): ?float
    {
        return $this->costoestimado;
    }

    public function setCostoestimado(float $costoestimado): self
    {
        $this->costoestimado = $costoestimado;

        return $this;
    }

    public function getTotalrecursosasignados(): ?float
    {
        return $this->totalrecursosasignados;
    }

    public function setTotalrecursosasignados(float $totalrecursosasignados): self
    {
        $this->totalrecursosasignados = $totalrecursosasignados;

        return $this;
    }

    public function getPlanarchivo(): ?string
    {
        return $this->planarchivo;
    }

    public function setPlanarchivo(string $planarchivo): self
    {
        $this->planarchivo = $planarchivo;

        return $this;
    }
}
