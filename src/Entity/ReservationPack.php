<?php

namespace App\Entity;

use App\Repository\ReservationPackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationPackRepository::class)]
class ReservationPack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $reservation_id = null;

    #[ORM\ManyToOne(targetEntity: PackEvenement::class)]
    #[ORM\JoinColumn(name: 'pack_id', referencedColumnName: 'pack_id', nullable: false)]
    private ?PackEvenement $pack = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbre_invites = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?float $budget_alloue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $qr_code_url = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_reservation = null;

    #[ORM\Column(length: 10)]
    private ?string $statut_reservation = 'en attente';

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(targetEntity: Locaux::class)]
    #[ORM\JoinColumn(name: 'lieu_id', referencedColumnName: 'id_local', nullable: true)]
    private ?Locaux $lieu = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\ManyToMany(targetEntity: Service::class)]
    #[ORM\JoinTable(name: 'reservationservice',
        joinColumns: [new ORM\JoinColumn(name: 'reservation_id', referencedColumnName: 'reservation_id')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'service_id', referencedColumnName: 'id_service')]
    )]
    private Collection $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->created_at = new \DateTime();
    }

    public function getReservationId(): ?int
    {
        return $this->reservation_id;
    }

    public function getPack(): ?PackEvenement
    {
        return $this->pack;
    }

    public function setPack(?PackEvenement $pack): self
    {
        $this->pack = $pack;
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

    public function getNbreInvites(): ?int
    {
        return $this->nbre_invites;
    }

    public function setNbreInvites(?int $nbre_invites): self
    {
        $this->nbre_invites = $nbre_invites;
        return $this;
    }

    public function getBudgetAlloue(): ?float
    {
        return $this->budget_alloue;
    }

    public function setBudgetAlloue(?float $budget_alloue): self
    {
        $this->budget_alloue = $budget_alloue;
        return $this;
    }

    public function getQrCodeUrl(): ?string
    {
        return $this->qr_code_url;
    }

    public function setQrCodeUrl(?string $qr_code_url): self
    {
        $this->qr_code_url = $qr_code_url;
        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): self
    {
        $this->date_reservation = $date_reservation;
        return $this;
    }

    public function getStatutReservation(): ?string
    {
        return $this->statut_reservation;
    }

    public function setStatutReservation(string $statut_reservation): self
    {
        $this->statut_reservation = $statut_reservation;
        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function getLieu(): ?Locaux
    {
        return $this->lieu;
    }

    public function setLieu(?Locaux $lieu): self
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
        }
        return $this;
    }

    public function removeService(Service $service): self
    {
        $this->services->removeElement($service);
        return $this;
    }
} 