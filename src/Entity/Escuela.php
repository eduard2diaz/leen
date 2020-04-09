<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EscuelaRepository")
 *@UniqueEntity("ccts")
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
     */
    private $d_codigo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $calle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $asentamiento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $noexterior;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoAsentamiento")
     */
    private $tipoasentamiento;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Municipio")
     */
    private $municipio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estado")
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estatus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estatus;


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

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(?string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getAsentamiento(): ?string
    {
        return $this->asentamiento;
    }

    public function setAsentamiento(?string $asentamiento): self
    {
        $this->asentamiento = $asentamiento;

        return $this;
    }

    public function getNoexterior(): ?string
    {
        return $this->noexterior;
    }

    public function setNoexterior(?string $noexterior): self
    {
        $this->noexterior = $noexterior;

        return $this;
    }

    public function getTipoasentamiento(): ?TipoAsentamiento
    {
        return $this->tipoasentamiento;
    }

    public function setTipoasentamiento(?TipoAsentamiento $tipoasentamiento): self
    {
        $this->tipoasentamiento = $tipoasentamiento;

        return $this;
    }

    public function getMunicipio(): ?Municipio
    {
        return $this->municipio;
    }

    public function setMunicipio(?Municipio $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function __toString()
    {
        return $this->getEscuela().' '.$this->getCcts();
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if(null==$this->getDCodigo()){
            if (null==$this->getTipoasentamiento())
                $context->addViolation('Seleccione un tipo de asentamiento.');

            if (empty($this->getAsentamiento()))
                $context->addViolation('Escriba el nombre del asentamiento.');

            if (empty($this->getNoexterior()))
                $context->addViolation('Escriba el Número Exterior.');

            if (empty($this->getCalle()))
                $context->addViolation('Escriba la calle.');

            if (null==$this->getEstado())
                $context->addViolation('Seleccione un estado.');
            else
                if (null==$this->getMunicipio())
                    $context->addViolation('Seleccione un municipio.');
                else
                    if ($this->getEstado()->getId()!=$this->getMunicipio()->getEstado()->getId())
                        $context->addViolation('Seleccione un municipio que pertenezca a dicho estado.');
        }
        else{
            $isError=null!=$this->getTipoasentamiento() ||
                     null!=$this->getEstado() ||
                     null!=$this->getMunicipio() ||
                     !empty($this->getAsentamiento()) ||
                     !empty($this->getNoexterior()) ||
                     !empty($this->getCalle());
            if($isError)
                $context->addViolation('Capte el código postal o la restante información pero no ambos.');
        }


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
