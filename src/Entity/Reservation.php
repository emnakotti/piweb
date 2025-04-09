<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: "App\Repository\ReservationRepository")]
#[ORM\Table(name: "reservation")]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $idReservation;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Service")]
    #[ORM\JoinColumn(name: "service_id", referencedColumnName: "id_service", onDelete: "CASCADE")]
    private $service;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User")]
    #[ORM\JoinColumn(name: "utilisateur_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private $utilisateur;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank(message: 'La date de réservation est obligatoire')]
    #[Assert\Type(\DateTimeInterface::class, message: 'La date doit être valide')]
    #[Assert\GreaterThanOrEqual(
        value: 'today',
        message: 'La date doit être ultérieure ou égale à aujourd\'hui'
    )]
    private ?\DateTimeInterface $dateReservation = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'La quantité est obligatoire')]
    #[Assert\Positive(message: 'La quantité doit être positive')]
    #[Assert\LessThanOrEqual(
        value: 100,
        message: 'Vous ne pouvez pas réserver plus de 100 unités'
    )]
    private $quantite;

    #[ORM\Column(
        type: "string",
        columnDefinition: "ENUM('En attente', 'Confirmée', 'Annulée') DEFAULT 'En attente'"
    )]
    private string $statut = 'En attente';

    #[ORM\Column(type: "datetime", nullable: true)]
    private $dateConfirmation;

    #[ORM\Column(type: "datetime", nullable: true)]
    private $dateAnnulation;

    // Getters and Setters

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;
        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;
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

    public function getDateConfirmation(): ?\DateTimeInterface
    {
        return $this->dateConfirmation;
    }

    public function setDateConfirmation(?\DateTimeInterface $dateConfirmation): self
    {
        $this->dateConfirmation = $dateConfirmation;
        return $this;
    }

    public function getDateAnnulation(): ?\DateTimeInterface
    {
        return $this->dateAnnulation;
    }

    public function setDateAnnulation(?\DateTimeInterface $dateAnnulation): self
    {
        $this->dateAnnulation = $dateAnnulation;
        return $this;
    }
    public function __construct()
    {
        $this->dateReservation = new \DateTime(); // Valeur par défaut
    }
}
