<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CodigoPostalRepository")
 * @UniqueEntity("d_cp")
 */
class CodigoPostal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $d_Asenta;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $d_cp;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $c_CP;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $id_asenta_cpcons;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $d_zona;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoAsentamiento")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipoasentamiento;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Municipio")
     * @ORM\JoinColumn(nullable=false)
     */
    private $municipio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estado")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciudad")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ciudad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDAsenta(): ?string
    {
        return $this->d_Asenta;
    }

    public function setDAsenta(string $d_Asenta): self
    {
        $this->d_Asenta = $d_Asenta;

        return $this;
    }


    public function getDMpio(): ?string
    {
        return $this->d_mpio;
    }

    public function setDMpio(string $d_mpio): self
    {
        $this->d_mpio = $d_mpio;

        return $this;
    }

    public function getDCp(): ?int
    {
        return $this->d_cp;
    }

    public function setDCp(int $d_cp): self
    {
        $this->d_cp = $d_cp;

        return $this;
    }

    public function getCEstado(): ?string
    {
        return $this->c_estado;
    }

    public function setCEstado(string $c_estado): self
    {
        $this->c_estado = $c_estado;

        return $this;
    }

    public function getCCP(): ?string
    {
        return $this->c_CP;
    }

    public function setCCP(string $c_CP): self
    {
        $this->c_CP = $c_CP;

        return $this;
    }

    public function getIdAsentaCpcons(): ?string
    {
        return $this->id_asenta_cpcons;
    }

    public function setIdAsentaCpcons(string $id_asenta_cpcons): self
    {
        $this->id_asenta_cpcons = $id_asenta_cpcons;

        return $this;
    }

    public function getDZona(): ?string
    {
        return $this->d_zona;
    }

    public function setDZona(string $d_zona): self
    {
        $this->d_zona = $d_zona;

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

    public function getCiudad(): ?Ciudad
    {
        return $this->ciudad;
    }

    public function setCiudad(?Ciudad $ciudad): self
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->getDCp();
    }


    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (null == $this->getEstado())
            $context->addViolation('Seleccione un estado.');
        else
            if (null == $this->getMunicipio())
                $context->addViolation('Seleccione un municipio.');
            else
                if (null == $this->getCiudad())
                    $context->addViolation('Seleccione una ciudad.');
                else
                    if ($this->getEstado()->getId() != $this->getMunicipio()->getEstado()->getId())
                        $context->addViolation('Seleccione un municipio que pertenezca a dicho estado.');
                    else
                        if ($this->getCiudad()->getMunicipio()->getId() != $this->getMunicipio()->getId())
                            $context->addViolation('Seleccione una ciudad que pertenezca a dicho municipio.');
    }
}
