<?php

namespace App\Entity;

use App\Repository\MoviesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoviesRepository::class)]
class Movies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $release_date = null;

    /**
     * @var Collection<int, Actors>
     */
    #[ORM\ManyToMany(targetEntity: Actors::class, mappedBy: 'movie')]
    private Collection $actors;

    /**
     * @var Collection<int, Genres>
     */
    #[ORM\ManyToMany(targetEntity: Genres::class, inversedBy: 'movies')]
    private Collection $genres;

    /**
     * @var Collection<int, Realisateurs>
     */
    #[ORM\ManyToMany(targetEntity: Realisateurs::class, inversedBy: 'movies')]
    private Collection $realisateurs;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $trailer = null;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeImmutable
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeImmutable $release_date): static
    {
        $this->release_date = $release_date;

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
            $actor->addMovie($this);
        }

        return $this;
    }

    public function removeActor(Actors $actor): static
    {
        if ($this->actors->removeElement($actor)) {
            $actor->removeMovie($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Genres>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genres $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genres $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, Realisateurs>
     */
    public function getRealisateurs(): Collection
    {
        return $this->realisateurs;
    }

    public function addRealisateur(Realisateurs $realisateur): static
    {
        if (!$this->realisateurs->contains($realisateur)) {
            $this->realisateurs->add($realisateur);
        }

        return $this;
    }

    public function removeRealisateur(Realisateurs $realisateur): static
    {
        $this->realisateurs->removeElement($realisateur);

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(?string $trailer): static
    {
        $this->trailer = $trailer;

        return $this;
    }
}
