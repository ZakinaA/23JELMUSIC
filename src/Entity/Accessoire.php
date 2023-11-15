<?php

namespace App\Entity;

use App\Repository\AccessoireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessoireRepository::class)]
class Accessoire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'accessoires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Instrument $id_instrument = null;

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

    public function getIdInstrument(): ?Instrument
    {
        return $this->id_instrument;
    }

    public function setIdInstrument(?Instrument $id_instrument): static
    {
        $this->id_instrument = $id_instrument;

        return $this;
    }
}
