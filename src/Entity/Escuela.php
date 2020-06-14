<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EscuelaRepository")
 * @UniqueEntity("coordenada")
 */
class Escuela
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "El nombre de la escuela no puede exceder los {{ limit }} caracteres",
     * )
     */
    private $escuela;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CodigoPostal")
     */
    private $d_codigo;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "El nombre de calle no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $calle;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "El nombre del asentamiento no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $asentamiento;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "El número exterior no puede exceder los {{ limit }} caracteres",
     *)
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

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TipoEnsenanza")
     */
    private $tipoensenanza;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EscuelaCCTS", mappedBy="escuela")
     */
    private $ccts_collection;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\Length(
     *      max = 80,
     *      maxMessage = "Ls coordenada no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $coordenada;

    /**
     * @Assert\Type(type="App\Entity\EscuelaCCTS")
     * @Assert\Valid
     */
    private $ccts;

    public function __construct()
    {
        $this->tipoensenanza = new ArrayCollection();
        $this->ccts_collection = new ArrayCollection();
    }


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
     * @return Collection|TipoEnsenanza[]
     */
    public function getTipoensenanza(): Collection
    {
        return $this->tipoensenanza;
    }

    public function addTipoensenanza(TipoEnsenanza $tipoensenanza): self
    {
        if (!$this->tipoensenanza->contains($tipoensenanza)) {
            $this->tipoensenanza[] = $tipoensenanza;
        }

        return $this;
    }

    public function getCoordenada(): ?string
    {
        return $this->coordenada;
    }

    public function setCoordenada(string $coordenada): self
    {
        $this->coordenada = $coordenada;

        return $this;
    }

    public function removeTipoensenanza(TipoEnsenanza $tipoensenanza): self
    {
        if ($this->tipoensenanza->contains($tipoensenanza)) {
            $this->tipoensenanza->removeElement($tipoensenanza);
        }

        return $this;
    }

    public function addCct(EscuelaCCTS $cct): self
    {
        if (!$this->ccts_collection->contains($cct)) {
            $this->ccts_collection[] = $cct;
            $cct->setEscuela($this);
        }

        return $this;
    }

    public function getccts_collection(){
        return $this->ccts_collection;
    }

    public function removeCct(EscuelaCCTS $cct): self
    {
        if ($this->ccts_collection->contains($cct)) {
            $this->ccts_collection->removeElement($cct);
            // set the owning side to null (unless already changed)
            if ($cct->getEscuela() === $this) {
                $cct->setEscuela(null);
            }
        }

        return $this;
    }

    public function getCcts(): ?EscuelaCCTS
    {
        return $this->ccts;
    }

    public function setCcts(EscuelaCCTS $ccts): self
    {
        $this->ccts = $ccts;
        $ccts->setEscuela($this);

        return $this;
    }

    public function __toString()
    {
        return $this->getEscuela();
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if($this->getTipoensenanza()->isEmpty())
            $context->addViolation('Seleccione al menos un tipo de enseñanza.');

        if (null==$this->getEstado())
            $context->addViolation('Seleccione un estado.');
        else
            if (null==$this->getMunicipio())
                $context->addViolation('Seleccione un municipio.');
            else
                if ($this->getEstado()->getId()!=$this->getMunicipio()->getEstado()->getId())
                    $context->addViolation('Seleccione un municipio que pertenezca a dicho estado.');
                else
                    if (null==$this->getDCodigo())
                        $context->addViolation('Seleccione un código postal.');
                    else
                        if ($this->getDCodigo()->getMunicipio()->getId()!=$this->getMunicipio()->getId())
                            $context->addViolation('Seleccione un código postal que pertenezca a dicho municipio.');
    }

}
