<?php

namespace App\Entity;

use App\Repository\PlacesRepository;
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
}
