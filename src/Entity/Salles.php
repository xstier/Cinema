<?php

namespace App\Entity;

use App\Repository\SallesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SallesRepository::class)]
class Salles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'salles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cinemas $id_cinema = null;

    #[ORM\Column(length: 255)]
    private ?string $qualite_projection = null;

    /**
     * @var Collection<int, Places>
     */
    #[ORM\OneToMany(targetEntity: Places::class, mappedBy: 'id_salle')]
    private Collection $places;

    /**
     * @var Collection<int, Seances>
     */
    #[ORM\OneToMany(targetEntity: Seances::class, mappedBy: 'id_salle')]
    private Collection $seances;

    public function __construct()
    {
        $this->places = new ArrayCollection();
        $this->seances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCinema(): ?Cinemas
    {
        return $this->id_cinema;
    }

    public function setIdCinema(?Cinemas $id_cinema): static
    {
        $this->id_cinema = $id_cinema;

        return $this;
    }

    public function getQualiteProjection(): ?string
    {
        return $this->qualite_projection;
    }

    public function setQualiteProjection(string $qualite_projection): static
    {
        $this->qualite_projection = $qualite_projection;

        return $this;
    }

    /**
     * @return Collection<int, Places>
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Places $place): static
    {
        if (!$this->places->contains($place)) {
            $this->places->add($place);
            $place->setIdSalle($this);
        }

        return $this;
    }

    public function removePlace(Places $place): static
    {
        if ($this->places->removeElement($place)) {
            // set the owning side to null (unless already changed)
            if ($place->getIdSalle() === $this) {
                $place->setIdSalle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Seances>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seances $seance): static
    {
        if (!$this->seances->contains($seance)) {
            $this->seances->add($seance);
            $seance->setIdSalle($this);
        }

        return $this;
    }

    public function removeSeance(Seances $seance): static
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getIdSalle() === $this) {
                $seance->setIdSalle(null);
            }
        }

        return $this;
    }
}
