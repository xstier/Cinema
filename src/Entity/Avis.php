<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    private ?Reservations $id_reservation = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $note = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $Commentaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_avis = null;

    #[ORM\Column]
    private ?bool $validation_avis = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(?string $Commentaire): static
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }

    public function getDateAvis(): ?\DateTimeInterface
    {
        return $this->date_avis;
    }

    public function setDateAvis(\DateTimeInterface $date_avis): static
    {
        $this->date_avis = $date_avis;

        return $this;
    }

    public function isValidationAvis(): ?bool
    {
        return $this->validation_avis;
    }

    public function setValidationAvis(bool $validation_avis): static
    {
        $this->validation_avis = $validation_avis;

        return $this;
    }
}
