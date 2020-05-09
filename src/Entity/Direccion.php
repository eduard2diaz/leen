<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DireccionRepository")
 */
class Direccion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CodigoPostal")
     * @ORM\JoinColumn(nullable=false)
     */
    private $d_codigo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $calle;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $numero_exterior;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getNumeroExterior(): ?int
    {
        return $this->numero_exterior;
    }

    public function setNumeroExterior(int $numero_exterior): self
    {
        $this->numero_exterior = $numero_exterior;

        return $this;
    }
}
