<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Recetario::class, mappedBy: 'relacion')]
    private Collection $relacionRecetario;

    public function __construct()
    {
        $this->relacionRecetario = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Recetario>
     */
    public function getRelacionRecetario(): Collection
    {
        return $this->relacionRecetario;
    }

    public function addRelacionRecetario(Recetario $relacionRecetario): self
    {
        if (!$this->relacionRecetario->contains($relacionRecetario)) {
            $this->relacionRecetario->add($relacionRecetario);
            $relacionRecetario->addRelacion($this);
        }

        return $this;
    }

    public function removeRelacionRecetario(Recetario $relacionRecetario): self
    {
        if ($this->relacionRecetario->removeElement($relacionRecetario)) {
            $relacionRecetario->removeRelacion($this);
        }

        return $this;
    }
}
