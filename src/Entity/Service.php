<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: "App\Repository\ServiceRepository")]
#[ORM\Table(name: "service")]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: Types::INTEGER)]
    private $idService;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private $nomService;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private $description;

    #[ORM\Column(type: Types::INTEGER)]
    private $prix;

    #[ORM\Column(type: "string", columnDefinition: "ENUM('Matériel', 'Staff')")]
    private $typeService;

    #[ORM\Column(type: Types::INTEGER)]
    private $disponibilite;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "utilisateur_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private $utilisateur;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private $imageUrl;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private $quantiteMateriel;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private $roleStaff;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private $experience;

    // Getters and Setters
    public function getIdService(): ?int
    {
        return $this->idService;
    }

    public function getNomService(): ?string
    {
        return $this->nomService;
    }

    public function setNomService(string $nomService): self
    {
        $this->nomService = $nomService;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getTypeService(): ?string
    {
        return $this->typeService;
    }

    public function setTypeService(string $typeService): self
    {
        $this->typeService = $typeService;
        return $this;
    }

    public function getDisponibilite(): ?int
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(int $disponibilite): self
    {
        $this->disponibilite = $disponibilite;
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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getQuantiteMateriel(): ?int
    {
        return $this->quantiteMateriel;
    }

    public function setQuantiteMateriel(?int $quantiteMateriel): self
    {
        $this->quantiteMateriel = $quantiteMateriel;
        return $this;
    }

    public function getRoleStaff(): ?string
    {
        return $this->roleStaff;
    }

    public function setRoleStaff(?string $roleStaff): self
    {
        $this->roleStaff = $roleStaff;
        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;
        return $this;
    }
}
