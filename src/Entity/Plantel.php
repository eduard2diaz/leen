<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity

 */
class Plantel
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
     *      maxMessage = "El nombre del plantel no puede exceder los {{ limit }} caracteres",
     * )
     */
    private $nombre;

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
     * @ORM\Column(type="string", length=80,nullable=true)
     * @Assert\Length(
     *      max = 80,
     *      maxMessage = "Ls coordenada no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $coord_geometry;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Escuela", mappedBy="plantel")
     */
    private $escuelas;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=3)
     */
    private $latitud;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=3)
     */
    private $longitud;

    public function __construct()
    {
        $this->escuelas = new ArrayCollection();
    }


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

    /**
     * @return mixed
     */
    public function getCoordGeometry()
    {
        return $this->coord_geometry;
    }

    /**
     * @param mixed $coord_geometry
     */
    public function setCoordGeometry($coord_geometry): void
    {
        $this->coord_geometry = $coord_geometry;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * @return Collection|Escuela[]
     */
    public function getEscuelas(): Collection
    {
        return $this->escuelas;
    }

    public function addEscuela(Escuela $escuela): self
    {
        if (!$this->escuelas->contains($escuela)) {
            $this->escuelas[] = $escuela;
            $escuela->setPlantel($this);
        }

        return $this;
    }

    public function removeEscuela(Escuela $escuela): self
    {
        if ($this->escuelas->contains($escuela)) {
            $this->escuelas->removeElement($escuela);
            // set the owning side to null (unless already changed)
            if ($escuela->getPlantel() === $this) {
                $escuela->setPlantel(null);
            }
        }

        return $this;
    }

    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    public function setLatitud(string $latitud): self
    {
        $this->latitud = $latitud;

        return $this;
    }

    public function getLongitud(): ?string
    {
        return $this->longitud;
    }

    public function setLongitud(string $longitud): self
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
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
