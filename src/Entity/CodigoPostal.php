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
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "El nombre del asentamiento no puede exceder los {{ limit }} caracteres",
     *)
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
     * @ORM\Column(type="string", length=5)
     * @Assert\Length(
     *      max = 5,
     *      maxMessage = "El identificador del asentamiento no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $id_asenta_cpcons;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "El nombre de la zona no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $d_zona;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "El CCP no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $c_CP;

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
     * @ORM\JoinColumn(nullable=true)
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


    public function getDCp(): ?int
    {
        return $this->d_cp;
    }

    public function setDCp(int $d_cp): self
    {
        $this->d_cp = $d_cp;

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
                if ($this->getEstado()->getId() != $this->getMunicipio()->getEstado()->getId())
                    $context->addViolation('Seleccione un municipio que pertenezca a dicho estado.');
                else
                    if ($this->getCiudad()!=null && $this->getCiudad()->getMunicipio()->getId() != $this->getMunicipio()->getId())
                        $context->addViolation('Seleccione una ciudad que pertenezca a dicho municipio.');
    }
}
