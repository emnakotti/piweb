<?php

namespace App\Entity;

use App\Repository\ReservationLocauxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationLocauxRepository::class)]
class ReservationLocaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_reservation = null;

    #[ORM\ManyToOne(targetEntity: Locaux::class)]
    #[ORM\JoinColumn(name: 'id_local', referencedColumnName: 'id_local', nullable: true)]
    private ?Locaux $local = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id', nullable: true)]
    private ?User $user = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(length: 50)]
    private ?string $statut = null;

    public function getIdReservation(): ?int
    {
        return $this->id_reservation;
    }

    public function getLocal(): ?Locaux
    {
        return $this->local;
    }

    public function setLocal(?Locaux $local): self
    {
        $this->local = $local;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;
        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }
} 