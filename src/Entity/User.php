<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'string', length: 5)]
    private ?string $role = 'user';

    #[ORM\Column(length: 255)]
    private ?string $is_active = 'nok';

    #[ORM\Column(nullable: true)]
    private ?int $num_tel = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_de_naissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo_profil = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $face_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $empreinte_pc = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $code_verification = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $code_expiration = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_verified = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $last_login = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $auth_mode = 'Mot de passe';

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $cin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    private ?int $verification_progress = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $profession = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getIsActive(): ?string
    {
        return $this->is_active;
    }

    public function setIsActive(string $is_active): self
    {
        $this->is_active = $is_active;
        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->num_tel;
    }

    public function setNumTel(?int $num_tel): self
    {
        $this->num_tel = $num_tel;
        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;
        return $this;
    }

    public function getPhotoProfil(): ?string
    {
        return $this->photo_profil;
    }

    public function setPhotoProfil(?string $photo_profil): self
    {
        $this->photo_profil = $photo_profil;
        return $this;
    }

    public function getFaceId()
    {
        return $this->face_id;
    }

    public function setFaceId($face_id): self
    {
        $this->face_id = $face_id;
        return $this;
    }

    public function getEmpreintePc(): ?string
    {
        return $this->empreinte_pc;
    }

    public function setEmpreintePc(?string $empreinte_pc): self
    {
        $this->empreinte_pc = $empreinte_pc;
        return $this;
    }

    public function getCodeVerification(): ?string
    {
        return $this->code_verification;
    }

    public function setCodeVerification(?string $code_verification): self
    {
        $this->code_verification = $code_verification;
        return $this;
    }

    public function getCodeExpiration(): ?\DateTimeInterface
    {
        return $this->code_expiration;
    }

    public function setCodeExpiration(?\DateTimeInterface $code_expiration): self
    {
        $this->code_expiration = $code_expiration;
        return $this;
    }

    public function isVerified(): ?bool
    {
        return $this->is_verified;
    }

    public function setIsVerified(?bool $is_verified): self
    {
        $this->is_verified = $is_verified;
        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->last_login;
    }

    public function setLastLogin(?\DateTimeInterface $last_login): self
    {
        $this->last_login = $last_login;
        return $this;
    }

    public function getAuthMode(): ?string
    {
        return $this->auth_mode;
    }

    public function setAuthMode(?string $auth_mode): self
    {
        $this->auth_mode = $auth_mode;
        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(?string $cin): self
    {
        $this->cin = $cin;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getVerificationProgress(): ?int
    {
        return $this->verification_progress;
    }

    public function setVerificationProgress(?int $verification_progress): self
    {
        $this->verification_progress = $verification_progress;
        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;
        return $this;
    }
}
