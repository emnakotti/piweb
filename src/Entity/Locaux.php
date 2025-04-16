<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: "App\Repository\LocauxRepository")]
#[ORM\Table(name: "locaux")]
class Locaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $idLocal;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User")]
    #[ORM\JoinColumn(name: "id_user", referencedColumnName: "id", onDelete: "CASCADE")]
    private $user;

    #[ORM\Column(type: "string", length: 255)]
    private $adresse;

    #[ORM\Column(type: "integer")]
    private $capacite;

    #[ORM\Column(type: "string", length: 100)]
    private $type;

    #[ORM\Column(type: "text", nullable: true)]
    private $photo;

    #[ORM\Column(type: "text", nullable: true)]
    private $equipement;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $tarifs;

    public function __construct()
    {
    }

    // Getters and Setters
    public function getIdLocal(): ?int
    {
        return $this->idLocal;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    public function getEquipement(): ?string
    {
        return $this->equipement;
    }

    public function setEquipement(?string $equipement): self
    {
        $this->equipement = $equipement;
        return $this;
    }

    public function getTarifs(): ?string
    {
        return $this->tarifs;
    }

    public function setTarifs(string $tarifs): self
    {
        $this->tarifs = $tarifs;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%s - %s', $this->getType() ?? '', $this->getAdresse() ?? '');
    }
}