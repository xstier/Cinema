<?php

namespace App\Entity;

use App\Repository\CinemasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CinemasRepository::class)]
class Cinemas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_cinema = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $numero_gsm = null;

    #[ORM\Column(length: 500)]
    private ?string $Horaires = null;

    /**
     * @var Collection<int, Salles>
     */
    #[ORM\OneToMany(targetEntity: Salles::class, mappedBy: 'id_cinema')]
    private Collection $salles;

    public function __construct()
    {
        $this->salles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCinema(): ?string
    {
        return $this->nom_cinema;
    }

    public function setNomCinema(string $nom_cinema): static
    {
        $this->nom_cinema = $nom_cinema;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumeroGsm(): ?string
    {
        return $this->numero_gsm;
    }

    public function setNumeroGsm(string $numero_gsm): static
    {
        $this->numero_gsm = $numero_gsm;

        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->Horaires;
    }

    public function setHoraires(string $Horaires): static
    {
        $this->Horaires = $Horaires;

        return $this;
    }

    /**
     * @return Collection<int, Salles>
     */
    public function getSalles(): Collection
    {
        return $this->salles;
    }

    public function addSalle(Salles $salle): static
    {
        if (!$this->salles->contains($salle)) {
            $this->salles->add($salle);
            $salle->setIdCinema($this);
        }

        return $this;
    }

    public function removeSalle(Salles $salle): static
    {
        if ($this->salles->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getIdCinema() === $this) {
                $salle->setIdCinema(null);
            }
        }

        return $this;
    }
}
