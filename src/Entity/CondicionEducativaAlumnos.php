<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CondicionEducativaAlumnosRepository")
 */
class CondicionEducativaAlumnos
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
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $numalumnas;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $numalumnos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GradoEnsenanza")
     * @ORM\JoinColumn(nullable=false)
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

    public function getNumalumnas(): ?int
    {
        return $this->numalumnas;
    }

    public function setNumalumnas(int $numalumnas): self
    {
        $this->numalumnas = $numalumnas;

        return $this;
    }

    public function getNumalumnos(): ?int
    {
        return $this->numalumnos;
    }

    public function setNumalumnos(int $numalumnos): self
    {
        $this->numalumnos = $numalumnos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGrado()
    {
        return $this->grado;
    }

    /**
     * @param mixed $grado
     */
    public function setGrado($grado): void
    {
        $this->grado = $grado;
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
