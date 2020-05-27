<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CondicionDocenteEducativaRepository")
 */
class CondicionDocenteEducativa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DiagnosticoPlantel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diagnostico;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "La clave del centro de trabajo no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $ccts;

    /**
     * @ORM\Column(type="string", length=18)
     * @Assert\Length(
     *      max = 18,
     *      maxMessage = "El CURP no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $curp;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "El nombre no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\Length(
     *      max = 4,
     *      maxMessage = "El grado no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $grado;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estatus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiagnostico(): ?DiagnosticoPlantel
    {
        return $this->diagnostico;
    }

    public function setDiagnostico(?DiagnosticoPlantel $diagnostico): self
    {
        $this->diagnostico = $diagnostico;

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

    public function getCurp(): ?string
    {
        return $this->curp;
    }

    public function setCurp(string $curp): self
    {
        $this->curp = $curp;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getGrado(): ?string
    {
        return $this->grado;
    }

    public function setGrado(string $grado): self
    {
        $this->grado = $grado;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * @param mixed $estatus
     */
    public function setEstatus($estatus): void
    {
        $this->estatus = $estatus;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (null==$this->getDiagnostico())
            $context->addViolation('Seleccione un diagnóstico.');
    }

}
