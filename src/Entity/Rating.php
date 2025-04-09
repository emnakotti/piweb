<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\RatingRepository")]
#[ORM\Table(name: "rating")]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $idRating;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", onDelete: "CASCADE", nullable: true)]
    private $user;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Service")]
    #[ORM\JoinColumn(name: "service_id", referencedColumnName: "id_service", onDelete: "CASCADE", nullable: true)]
    private $service;

    #[ORM\Column(type: "integer")]
    private $rating;

    #[ORM\Column(type: "datetime", nullable: true)]
    private $dateRating;

    // Getters and Setters

    public function getIdRating(): ?int
    {
        return $this->idRating;
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

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function getDateRating(): ?\DateTimeInterface
    {
        return $this->dateRating;
    }

    public function setDateRating(?\DateTimeInterface $dateRating): self
    {
        $this->dateRating = $dateRating;
        return $this;
    }
}
