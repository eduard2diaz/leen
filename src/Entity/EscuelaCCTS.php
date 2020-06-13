<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity
 *@UniqueEntity("value")
 */
class EscuelaCCTS
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escuela", inversedBy="ccts_collection")
     * @ORM\JoinColumn(nullable=false)
     */
    private $escuela;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "La clave del centro de Trabajo no puede exceder los {{ limit }} caracteres",
     * )
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEscuela(): ?Escuela
    {
        return $this->escuela;
    }

    public function setEscuela(?Escuela $escuela): self
    {
        $this->escuela = $escuela;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if(!$this->getEscuela())
            $context->addViolation('Seleccione una escuela.');
    }
}
