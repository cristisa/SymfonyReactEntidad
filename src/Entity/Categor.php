<?php

namespace App\Entity;

use App\Repository\CategorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorRepository::class)]
class Categor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nombreCategoria = null;

    #[ORM\ManyToMany(targetEntity: Receta::class, mappedBy: 'relacion')]
    private Collection $relacionReceta;

    public function __construct()
    {
        $this->relacionReceta = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombreCategoria();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreCategoria(): ?string
    {
        return $this->nombreCategoria;
    }

    public function setNombreCategoria(string $nombreCategoria): self
    {
        $this->nombreCategoria = $nombreCategoria;

        return $this;
    }

    /**
     * @return Collection<int, Receta>
     */
    public function getRelacionReceta(): Collection
    {
        return $this->relacionReceta;
    }

    public function addRelacionRecetum(Receta $relacionRecetum): self
    {
        if (!$this->relacionReceta->contains($relacionRecetum)) {
            $this->relacionReceta->add($relacionRecetum);
            $relacionRecetum->addRelacion($this);
        }

        return $this;
    }

    public function removeRelacionRecetum(Receta $relacionRecetum): self
    {
        if ($this->relacionReceta->removeElement($relacionRecetum)) {
            $relacionRecetum->removeRelacion($this);
        }

        return $this;
    }
}
