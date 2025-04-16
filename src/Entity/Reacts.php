<?php

namespace App\Entity;

use App\Repository\ReactsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReactsRepository::class)]
class Reacts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_react = null;

    #[ORM\ManyToOne(targetEntity: Posts::class, inversedBy: 'reacts')]
    #[ORM\JoinColumn(name: 'id_post', referencedColumnName: 'id_post', nullable: false)]
    private ?Posts $post = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: 'string', length: 7)]
    private ?string $reaction = null;

    public function getIdReact(): ?int
    {
        return $this->id_react;
    }

    public function getPost(): ?Posts
    {
        return $this->post;
    }

    public function setPost(?Posts $post): self
    {
        $this->post = $post;
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

    public function getReaction(): ?string
    {
        return $this->reaction;
    }

    public function setReaction(string $reaction): self
    {
        $this->reaction = $reaction;
        return $this;
    }
} 