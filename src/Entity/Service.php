<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\ServiceRepository")]
#[ORM\Table(name: "service")]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $idService;

    #[ORM\Column(type: "string", length: 255)]
    private $nomService;

    #[ORM\Column(type: "text", nullable: true)]
    private $description;

    #[ORM\Column(type: "integer")]
    private $prix;

    #[ORM\Column(type: "string", columnDefinition: "ENUM('Matériel', 'Staff')")]
    private $typeService;

    #[ORM\Column(type: "integer")]
    private $disponibilite;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User")]
    #[ORM\JoinColumn(name: "utilisateur_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private $utilisateur;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $imageUrl;

    #[ORM\Column(type: "integer", nullable: true)]
    private $quantiteMateriel;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $roleStaff;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
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
