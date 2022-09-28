<?php

namespace App\Entity;

use App\Repository\RecetaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetaRepository::class)]
class Receta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nombreReceta = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $ingredientes = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $procedimientos = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $autor = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $imagen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreReceta(): ?string
    {
        return $this->nombreReceta;
    }

    public function setNombreReceta(string $nombreReceta): self
    {
        $this->nombreReceta = $nombreReceta;

        return $this;
    }

    public function getIngredientes(): ?string
    {
        return $this->ingredientes;
    }

    public function setIngredientes(?string $ingredientes): self
    {
        $this->ingredientes = $ingredientes;

        return $this;
    }

    public function getProcedimientos(): ?string
    {
        return $this->procedimientos;
    }

    public function setProcedimientos(?string $procedimientos): self
    {
        $this->procedimientos = $procedimientos;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }
}
