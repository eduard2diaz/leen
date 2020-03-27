<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CodigoPostalRepository")
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
     * @ORM\Column(type="string", length=150)
     */
    private $d_tipoasenta;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $d_mpio;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $d_estado;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $d_ciudad;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $d_cp;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $c_estado;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $c_CP;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $c_tipoasenta;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $c_municipio;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $id_asenta_cpcons;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $d_zona;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $c_cve_ciudad;

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

    public function getDTipoasenta(): ?string
    {
        return $this->d_tipoasenta;
    }

    public function setDTipoasenta(string $d_tipoasenta): self
    {
        $this->d_tipoasenta = $d_tipoasenta;

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

    public function getDEstado(): ?string
    {
        return $this->d_estado;
    }

    public function setDEstado(string $d_estado): self
    {
        $this->d_estado = $d_estado;

        return $this;
    }

    public function getDCiudad(): ?string
    {
        return $this->d_ciudad;
    }

    public function setDCiudad(string $d_ciudad): self
    {
        $this->d_ciudad = $d_ciudad;

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

    public function getCTipoasenta(): ?int
    {
        return $this->c_tipoasenta;
    }

    public function setCTipoasenta(int $c_tipoasenta): self
    {
        $this->c_tipoasenta = $c_tipoasenta;

        return $this;
    }

    public function getCMunicipio(): ?string
    {
        return $this->c_municipio;
    }

    public function setCMunicipio(string $c_municipio): self
    {
        $this->c_municipio = $c_municipio;

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

    public function getCCveCiudad(): ?string
    {
        return $this->c_cve_ciudad;
    }

    public function setCCveCiudad(string $c_cve_ciudad): self
    {
        $this->c_cve_ciudad = $c_cve_ciudad;

        return $this;
    }

    public function __toString()
    {
        return $this->getCCP();
    }
}
