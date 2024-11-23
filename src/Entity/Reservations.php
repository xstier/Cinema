<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $email = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Seances $id_seance = null;

    #[ORM\Column]
    private ?int $nb_places = null;

    #[ORM\Column]
    private ?float $prix_total = null;

    #[ORM\Column(length: 255)]
    private ?string $QR_code = null;

    /**
     * @var Collection<int, ReservationsPlaces>
     */
    #[ORM\OneToMany(targetEntity: ReservationsPlaces::class, mappedBy: 'id_reservation')]
    private Collection $reservationsPlaces;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'id_reservation')]
    private Collection $avis;

    public function __construct()
    {
        $this->reservationsPlaces = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?User
    {
        return $this->email;
    }

    public function setEmail(?User $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getIdSeance(): ?Seances
    {
        return $this->id_seance;
    }

    public function setIdSeance(?Seances $id_seance): static
    {
        $this->id_seance = $id_seance;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nb_places;
    }

    public function setNbPlaces(int $nb_places): static
    {
        $this->nb_places = $nb_places;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prix_total;
    }

    public function setPrixTotal(float $prix_total): static
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    public function getQRCode(): ?string
    {
        return $this->QR_code;
    }

    public function setQRCode(string $QR_code): static
    {
        $this->QR_code = $QR_code;

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
            $reservationsPlace->setIdReservation($this);
        }

        return $this;
    }

    public function removeReservationsPlace(ReservationsPlaces $reservationsPlace): static
    {
        if ($this->reservationsPlaces->removeElement($reservationsPlace)) {
            // set the owning side to null (unless already changed)
            if ($reservationsPlace->getIdReservation() === $this) {
                $reservationsPlace->setIdReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setIdReservation($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getIdReservation() === $this) {
                $avi->setIdReservation(null);
            }
        }

        return $this;
    }
}
