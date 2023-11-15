<?php

namespace App\Entity;

use App\Repository\TypeInstrumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeInstrumentRepository::class)]
class TypeInstrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'typeInstruments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClasseInstrument $id_classe = null;

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

    public function getIdClasse(): ?ClasseInstrument
    {
        return $this->id_classe;
    }

    public function setIdClasse(?ClasseInstrument $id_classe): static
    {
        $this->id_classe = $id_classe;

        return $this;
    }
}
