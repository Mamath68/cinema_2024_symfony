<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolesRepository::class)]
class Roles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Actors>
     */
    #[ORM\ManyToMany(targetEntity: Actors::class, mappedBy: 'roles')]
    private Collection $actors;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Actors>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actors $actor): static
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
            $actor->addRole($this);
        }

        return $this;
    }

    public function removeActor(Actors $actor): static
    {
        if ($this->actors->removeElement($actor)) {
            $actor->removeRole($this);
        }

        return $this;
    }
}
