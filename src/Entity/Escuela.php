<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EscuelaRepository")
 */
class Escuela
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $escuela;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ccts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CodigoPostal")
     * @ORM\JoinColumn(nullable=false)
     */
    private $d_codigo;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEscuela(): ?string
    {
        return $this->escuela;
    }

    public function setEscuela(string $escuela): self
    {
        $this->escuela = $escuela;

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

    public function getDCodigo(): ?CodigoPostal
    {
        return $this->d_codigo;
    }

    public function setDCodigo(?CodigoPostal $d_codigo): self
    {
        $this->d_codigo = $d_codigo;

        return $this;
    }

}
