<?php

namespace App\Entity;

use App\Repository\PlacesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlacesRepository::class)]
class Places
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'places')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Salles $id_salle = null;

    #[ORM\Column]
    private ?bool $handicap = null;

    #[ORM\Column]
    private ?int $Rangee = null;

    /**
     * @var Collection<int, ReservationsPlaces>
     */
    #[ORM\OneToMany(targetEntity: ReservationsPlaces::class, mappedBy: 'id_place')]
    private Collection $reservationsPlaces;

    public function __construct()
    {
        $this->reservationsPlaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSalle(): ?Salles
    {
        return $this->id_salle;
    }

    public function setIdSalle(?Salles $id_salle): static
    {
        $this->id_salle = $id_salle;

        return $this;
    }

    public function isHandicap(): ?bool
    {
        return $this->handicap;
    }

    public function setHandicap(bool $handicap): static
    {
        $this->handicap = $handicap;

        return $this;
    }

    public function getRangee(): ?int
    {
        return $this->Rangee;
    }

    public function setRangee(int $Rangee): static
    {
        $this->Rangee = $Rangee;

        return $this;
    }

    /**
     * @return Collection<int, ReservationsPlaces>
     */
    public function getReservationsPlaces(): Collection
    {
        return $this->reservationsPlaces;
    }

    public function addReservationsPlace(ReservationsPlaces $reservationsPlace): static
    {
        if (!$this->reservationsPlaces->contains($reservationsPlace)) {
            $this->reservationsPlaces->add($reservationsPlace);
            $reservationsPlace->setIdPlace($this);
        }

        return $this;
    }

    public function removeReservationsPlace(ReservationsPlaces $reservationsPlace): static
    {
        if ($this->reservationsPlaces->removeElement($reservationsPlace)) {
            // set the owning side to null (unless already changed)
            if ($reservationsPlace->getIdPlace() === $this) {
                $reservationsPlace->setIdPlace(null);
            }
        }

        return $this;
    }
}
