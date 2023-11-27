<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use App\Entity\ContratPret;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EleveRepository::class)]
class Eleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 20)]
    private ?string $numRue = null;

    #[ORM\Column(length: 50)]
    private ?string $rue = null;

    #[ORM\Column(length: 10)]
    private ?string $copos = null;

    #[ORM\Column(length: 30)]
    private ?string $ville = null;

    #[ORM\Column(length: 20)]
    private ?string $tel = null;

    #[ORM\Column(length: 30)]
    private ?string $mail = null;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: Inscription::class)]
    private Collection $inscriptions;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: ContratPret::class)]
    private Collection $contratprets;

    #[ORM\ManyToMany(targetEntity: Responsable::class, inversedBy: 'eleves')]
    private Collection $responsables;


    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->contratprets = new ArrayCollection();
        $this->responsables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumRue(): ?string
    {
        return $this->numRue;
    }

    public function setNumRue(string $numRue): static
    {
        $this->numRue = $numRue;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCopos(): ?string
    {
        return $this->copos;
    }

    public function setCopos(string $copos): static
    {
        $this->copos = $copos;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setEleve($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEleve() === $this) {
                $inscription->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ContratPret>
     */
    public function getContratprets(): Collection
    {
        return $this->contratprets;
    }

    public function addContratPret(ContratPret $contratpret): static
    {
        if (!$this->contratprets->contains($contratpret)) {
            $this->contratprets->add($contratpret);
            $contratpret->setEleve($this);
        }

        return $this;
    }

    public function removeContratPret(ContratPret $contratpret): static
    {
        if ($this->contratprets->removeElement($contratpret)) {
            // set the owning side to null (unless already changed)
            if ($contratpret->getEleve() === $this) {
                $contratpret->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Responsable>
     */
    public function getResponsables(): Collection
    {
        return $this->responsables;
    }

    public function addResponsable(Responsable $responsable): static
    {
        if (!$this->responsables->contains($responsable)) {
            $this->responsables->add($responsable);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): static
    {
        $this->responsables->removeElement($responsable);

        return $this;
    }

}
