<?php

namespace App\Entity;

use App\Repository\MikroskopRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MikroskopRepository::class)]
class Mikroskop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $inventarnummer = null;

    #[ORM\Column(length: 255)]
    private ?string $hersteller = null;

    #[ORM\Column(length: 255)]
    private ?string $modell = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ausgeliehen = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $letztePruefung = null;

    #[ORM\ManyToOne(inversedBy: 'mikroskope')]
    private ?Lagerort $Lagerort = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInventarnummer(): ?string
    {
        return $this->inventarnummer;
    }

    public function setInventarnummer(string $inventarnummer): static
    {
        $this->inventarnummer = $inventarnummer;

        return $this;
    }

    public function getHersteller(): ?string
    {
        return $this->hersteller;
    }

    public function setHersteller(string $hersteller): static
    {
        $this->hersteller = $hersteller;

        return $this;
    }

    public function getModell(): ?string
    {
        return $this->modell;
    }

    public function setModell(string $modell): static
    {
        $this->modell = $modell;

        return $this;
    }

    public function isAusgeliehen(): ?bool
    {
        return $this->ausgeliehen;
    }

    public function setAusgeliehen(?bool $ausgeliehen): static
    {
        $this->ausgeliehen = $ausgeliehen;

        return $this;
    }

    public function getLetztePruefung(): ?\DateTimeInterface
    {
        return $this->letztePruefung;
    }

    public function setLetztePruefung(?\DateTimeInterface $letztePruefung): static
    {
        $this->letztePruefung = $letztePruefung;

        return $this;
    }

    public function getLagerort(): ?Lagerort
    {
        return $this->Lagerort;
    }

    public function setLagerort(?Lagerort $Lagerort): static
    {
        $this->Lagerort = $Lagerort;

        return $this;
    }
}
