<?php

namespace App\Entity;

use App\Repository\SeancesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeancesRepository::class)]
class Seances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_seance = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_fin = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Salles $id_salle = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Films $id_film = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSeance(): ?\DateTimeInterface
    {
        return $this->date_seance;
    }

    public function setDateSeance(\DateTimeInterface $date_seance): static
    {
        $this->date_seance = $date_seance;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heure_debut;
    }

    public function setHeureDebut(\DateTimeInterface $heure_debut): static
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTimeInterface $heure_fin): static
    {
        $this->heure_fin = $heure_fin;

        return $this;
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

    public function getIdFilm(): ?Films
    {
        return $this->id_film;
    }

    public function setIdFilm(?Films $id_film): static
    {
        $this->id_film = $id_film;

        return $this;
    }
}
