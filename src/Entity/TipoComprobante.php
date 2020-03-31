<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipoComprobanteRepository")
 * @UniqueEntity(fields={"comprobante","estatus"},message="Este valor ya ha sido usado con este Estatus")
 */
class TipoComprobante
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $comprobante;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\Column(type="date")
     */
    private $fechacaptura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estatus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estatus;

    public function __construct()
    {
        $this->setFechacaptura(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComprobante(): ?string
    {
        return $this->comprobante;
    }

    public function setComprobante(string $comprobante): self
    {
        $this->comprobante = $comprobante;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

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

    public function getEstatus(): ?Estatus
    {
        return $this->estatus;
    }

    public function setEstatus(?Estatus $estatus): self
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (null==$this->getEstatus())
            $context->addViolation('Seleccione un estatus.');
    }
}
