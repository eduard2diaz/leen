<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity("nombre")
 * @UniqueEntity("clave")
 */
class TipoAsentamiento
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
     *      maxMessage = "El nombre del tipo de asentamiento no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     * )
     */
    private $clave;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getClave(): ?int
    {
        return $this->clave;
    }

    public function setClave(int $clave): self
    {
        $this->clave = $clave;

        return $this;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}
