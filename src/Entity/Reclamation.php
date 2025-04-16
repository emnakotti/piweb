<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: 'text')]
    private ?string $user_message = null;

    #[ORM\Column(type: 'text')]
    private ?string $chat_response = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserMessage(): ?string
    {
        return $this->user_message;
    }

    public function setUserMessage(string $user_message): self
    {
        $this->user_message = $user_message;
        return $this;
    }

    public function getChatResponse(): ?string
    {
        return $this->chat_response;
    }

    public function setChatResponse(string $chat_response): self
    {
        $this->chat_response = $chat_response;
        return $this;
    }
} 