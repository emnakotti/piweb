<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
#[ORM\Table(name: 'comments')]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_comment = null;

    #[ORM\ManyToOne(targetEntity: Posts::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(name: 'id_post', referencedColumnName: 'id_post', onDelete: 'CASCADE')]
    private ?Posts $post = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?User $user = null;

    #[ORM\Column(type: 'text')]
    private ?string $content = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_comment = null;

    #[ORM\Column(length: 255)]
    private ?string $gif_url = null;

    public function getIdComment(): ?int
    {
        return $this->id_comment;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getDateComment(): ?\DateTimeInterface
    {
        return $this->date_comment;
    }

    public function setDateComment(\DateTimeInterface $date_comment): self
    {
        $this->date_comment = $date_comment;
        return $this;
    }

    public function getGifUrl(): ?string
    {
        return $this->gif_url;
    }

    public function setGifUrl(string $gif_url): self
    {
        $this->gif_url = $gif_url;
        return $this;
    }
} 