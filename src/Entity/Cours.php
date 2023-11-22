<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $libelle = null;

    #[ORM\Column(length: 20)]
    private ?string $AgeMini = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $HeureDebut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $HeureFin = null;

    #[ORM\Column]
    private ?int $NbPlaces = null;

    #[ORM\Column(length: 20)]
    private ?string $AgeMaxi = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?TypeCours $typeCours = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Jours $jours = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Professeur $professeur = null;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: Inscription::class)]
    private Collection $eleve;

    public function __construct()
    {
        $this->eleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getAgeMini(): ?string
    {
        return $this->AgeMini;
    }

    public function setAgeMini(string $AgeMini): static
    {
        $this->AgeMini = $AgeMini;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->HeureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $HeureDebut): static
    {
        $this->HeureDebut = $HeureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->HeureFin;
    }

    public function setHeureFin(\DateTimeInterface $HeureFin): static
    {
        $this->HeureFin = $HeureFin;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->NbPlaces;
    }

    public function setNbPlaces(int $NbPlaces): static
    {
        $this->NbPlaces = $NbPlaces;

        return $this;
    }

    public function getAgeMaxi(): ?string
    {
        return $this->AgeMaxi;
    }

    public function setAgeMaxi(string $AgeMaxi): static
    {
        $this->AgeMaxi = $AgeMaxi;

        return $this;
    }

    public function getTypeCours(): ?TypeCours
    {
        return $this->typeCours;
    }

    public function setTypeCours(?TypeCours $typeCours): static
    {
        $this->typeCours = $typeCours;

        return $this;
    }

    public function getJours(): ?Jours
    {
        return $this->jours;
    }

    public function setJours(?Jours $jours): static
    {
        $this->jours = $jours;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): static
    {
        $this->professeur = $professeur;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getEleve(): Collection
    {
        return $this->eleve;
    }

    public function addEleve(Inscription $eleve): static
    {
        if (!$this->eleve->contains($eleve)) {
            $this->eleve->add($eleve);
            $eleve->setCours($this);
        }

        return $this;
    }

    public function removeEleve(Inscription $eleve): static
    {
        if ($this->eleve->removeElement($eleve)) {
            // set the owning side to null (unless already changed)
            if ($eleve->getCours() === $this) {
                $eleve->setCours(null);
            }
        }

        return $this;
    }
}
