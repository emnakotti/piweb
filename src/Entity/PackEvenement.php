<?php
namespace App\Entity;

use App\DBAL\Types\EnumType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use App\Entity\Locaux;
use App\Entity\Service;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;


#[ORM\Entity(repositoryClass: "App\Repository\PackEvenementRepository")]
#[ORM\Table(name: "packevenement")]
#[ORM\HasLifecycleCallbacks]
class PackEvenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: Types::INTEGER)]
    private $packId;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(message: "Le nom du pack est obligatoire")]
    #[Assert\Length(
    min: 3,
    max: 255,
    minMessage: "Le nom doit contenir au moins {{ limit }} caractères",
    maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères"
    )]
    private $nom;

    #[ORM\Column(type: "string", columnDefinition: "ENUM('Mariage', 'Conférence', 'Fête', 'Autre')")]
    #[Assert\NotBlank(message: "Le type d'événement est obligatoire")]
    #[Assert\Choice(choices: ["Mariage", "Conférence", "Fête", "Autre"])]
    private $type;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(min: 10)]
    private $description;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private $prix;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    #[Assert\Positive]
    private $nbreInvitesMax;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Assert\Positive]
    private $budgetPrevu;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\GreaterThan("today")]
    private $dateEvenement;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\ManyToOne(targetEntity: Locaux::class)]
    #[ORM\JoinColumn(name: 'lieu_id', referencedColumnName: 'id_local')]
    private ?Locaux $lieu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    private $dateCreation;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    private $dateModification;

    #[ORM\Column(type: "string", columnDefinition: "ENUM('actif', 'inactif', 'archivé')")]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['actif', 'inactif', 'archivé'])]
    private $statut;

    #[ORM\ManyToMany(targetEntity: Service::class)]
    #[ORM\JoinTable(name: 'packservice',
        joinColumns: [new ORM\JoinColumn(name: 'pack_id', referencedColumnName: 'pack_id')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'service_id', referencedColumnName: 'id_service')]
    )]
    private Collection $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->dateCreation = new \DateTime();
        $this->dateModification = new \DateTime();
    }
    

    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->dateModification = new \DateTime();
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

    public function getPackId(): ?int
    {
        return $this->packId;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getNbreInvitesMax(): ?int
    {
        return $this->nbreInvitesMax;
    }

    public function setNbreInvitesMax(?int $nbreInvitesMax): self
    {
        $this->nbreInvitesMax = $nbreInvitesMax;
        return $this;
    }

    public function getBudgetPrevu(): ?string
    {
        return $this->budgetPrevu;
    }

    public function setBudgetPrevu(?string $budgetPrevu): self
    {
        $this->budgetPrevu = $budgetPrevu;
        return $this;
    }

    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement(?\DateTimeInterface $dateEvenement): self
    {
        $this->dateEvenement = $dateEvenement;
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(\DateTimeInterface $dateModification): self
    {
        $this->dateModification = $dateModification;
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

    public function isActive(): bool
    {
        return $this->statut === 'actif';
    }

    public function isArchived(): bool
    {
        return $this->statut === 'archivé';
    }
}