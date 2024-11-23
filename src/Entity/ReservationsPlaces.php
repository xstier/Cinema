<?php

namespace App\Entity;

use App\Repository\ReservationsPlacesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsPlacesRepository::class)]
class ReservationsPlaces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservationsPlaces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Places $id_place = null;

    #[ORM\ManyToOne(inversedBy: 'reservationsPlaces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservations $id_reservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPlace(): ?Places
    {
        return $this->id_place;
    }

    public function setIdPlace(?Places $id_place): static
    {
        $this->id_place = $id_place;

        return $this;
    }

    public function getIdReservation(): ?Reservations
    {
        return $this->id_reservation;
    }

    public function setIdReservation(?Reservations $id_reservation): static
    {
        $this->id_reservation = $id_reservation;

        return $this;
    }
}
