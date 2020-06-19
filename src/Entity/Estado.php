<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstadoRepository")
 * @UniqueEntity("nombre")
 * @UniqueEntity("clave")
 */
class Estado
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
     *      maxMessage = "El nombre del estado no puede exceder los {{ limit }} caracteres",
     *)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "La clave del estado no puede exceder los {{ limit }} caracteres",
     *)
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

    public function setClave(string $clave): self
    {
        $this->clave = $clave;

        return $this;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}
