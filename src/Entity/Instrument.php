<?php

namespace App\Entity;

use App\Repository\InstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstrumentRepository::class)]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numSerie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAchat = null;

    #[ORM\Column]
    private ?float $prixAchat = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $utilisation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cheminImage = null;

    #[ORM\ManyToOne(inversedBy: 'instruments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'instruments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeInstrument $type = null;

    #[ORM\OneToMany(mappedBy: 'instrument', targetEntity: Accessoire::class)]
    private Collection $accessoires;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: couleur::class, inversedBy: 'instruments')]
    private Collection $couleurs;

    public function __construct()
    {
        $this->accessoires = new ArrayCollection();
        $this->couleurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSerie(): ?int
    {
        return $this->numSerie;
    }

    public function setNumSerie(int $numSerie): static
    {
        $this->numSerie = $numSerie;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): static
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(float $prixAchat): static
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getUtilisation(): ?string
    {
        return $this->utilisation;
    }

    public function setUtilisation(?string $utilisation): static
    {
        $this->utilisation = $utilisation;

        return $this;
    }

    public function getCheminImage(): ?string
    {
        return $this->cheminImage;
    }

    public function setCheminImage(?string $cheminImage): static
    {
        $this->cheminImage = $cheminImage;

        return $this;
    }
    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getType(): ?TypeInstrument
    {
        return $this->type;
    }

    public function setType(?TypeInstrument $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Accessoire>
     */
    public function getAccessoires(): Collection
    {
        return $this->accessoires;
    }

    public function addAccessoire(Accessoire $accessoire): static
    {
        if (!$this->accessoires->contains($accessoire)) {
            $this->accessoires->add($accessoire);
            $accessoire->setInstrument($this);
        }

        return $this;
    }

    public function removeAccessoire(Accessoire $accessoire): static
    {
        if ($this->accessoires->removeElement($accessoire)) {
            // set the owning side to null (unless already changed)
            if ($accessoire->getInstrument() === $this) {
                $accessoire->setInstrument(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, couleur>
     */
    public function getCouleurs(): Collection
    {
        return $this->couleurs;
    }

    public function addCouleur(couleur $couleur): static
    {
        if (!$this->couleurs->contains($couleur)) {
            $this->couleurs->add($couleur);
        }

        return $this;
    }

    public function removeCouleur(couleur $couleur): static
    {
        $this->couleurs->removeElement($couleur);

        return $this;
    }
}