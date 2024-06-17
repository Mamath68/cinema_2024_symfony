<?php

namespace App\Entity;

use App\Repository\ActorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorsRepository::class)]
class Actors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $deathdate = null;

    /**
     * @var Collection<int, Movies>
     */
    #[ORM\ManyToMany(targetEntity: Movies::class, inversedBy: 'actors')]
    private Collection $movie;

    /**
     * @var Collection<int, Roles>
     */
    #[ORM\ManyToMany(targetEntity: Roles::class, inversedBy: 'actors')]
    private Collection $roles;

    public function __construct()
    {
        $this->movie = new ArrayCollection();
        $this->roles = new ArrayCollection();
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

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getDeathdate(): ?\DateTimeInterface
    {
        return $this->deathdate;
    }

    public function setDeathdate(?\DateTimeInterface $deathdate): static
    {
        $this->deathdate = $deathdate;

        return $this;
    }

    /**
     * @return Collection<int, Movies>
     */
    public function getMovie(): Collection
    {
        return $this->movie;
    }

    public function addMovie(Movies $movie): static
    {
        if (!$this->movie->contains($movie)) {
            $this->movie->add($movie);
        }

        return $this;
    }

    public function removeMovie(Movies $movie): static
    {
        $this->movie->removeElement($movie);

        return $this;
    }

    /**
     * @return Collection<int, Roles>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Roles $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    public function removeRole(Roles $role): static
    {
        $this->roles->removeElement($role);

        return $this;
    }
}
