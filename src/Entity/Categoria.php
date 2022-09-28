<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $nombreCategoria = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreCategoria(): ?string
    {
        return $this->nombreCategoria;
    }

    public function setNombreCategoria(?string $nombreCategoria): self
    {
        $this->nombreCategoria = $nombreCategoria;

        return $this;
    }
}
