<?php

namespace App\Entity;

use App\Repository\RecetarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetarioRepository::class)]
class Recetario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Categoria::class, inversedBy: 'relacionRecetario')]
    private Collection $relacion;

    public function __construct()
    {
        $this->relacion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Categoria>
     */
    public function getRelacion(): Collection
    {
        return $this->relacion;
    }

    public function addRelacion(Categoria $relacion): self
    {
        if (!$this->relacion->contains($relacion)) {
            $this->relacion->add($relacion);
        }

        return $this;
    }

    public function removeRelacion(Categoria $relacion): self
    {
        $this->relacion->removeElement($relacion);

        return $this;
    }
}
