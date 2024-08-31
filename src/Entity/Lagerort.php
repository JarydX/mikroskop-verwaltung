<?php

namespace App\Entity;

use App\Repository\LagerortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LagerortRepository::class)]
class Lagerort
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Kurzbeschreibung = null;

    #[ORM\Column(length: 255)]
    private ?string $Etage = null;

    #[ORM\Column(length: 255)]
    private ?string $Raum = null;

    #[ORM\Column(length: 255)]
    private ?string $Schranknummer = null;

    /**
     * @var Collection<int, Mikroskop>
     */
    #[ORM\OneToMany(targetEntity: Mikroskop::class, mappedBy: 'Lagerort')]
    private Collection $mikroskope;

    public function __construct()
    {
        $this->mikroskope = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKurzbeschreibung(): ?string
    {
        return $this->Kurzbeschreibung;
    }

    public function setKurzbeschreibung(string $Kurzbeschreibung): static
    {
        $this->Kurzbeschreibung = $Kurzbeschreibung;

        return $this;
    }

    public function getEtage(): ?string
    {
        return $this->Etage;
    }

    public function setEtage(string $Etage): static
    {
        $this->Etage = $Etage;

        return $this;
    }

    public function getRaum(): ?string
    {
        return $this->Raum;
    }

    public function setRaum(string $Raum): static
    {
        $this->Raum = $Raum;

        return $this;
    }

    public function getSchranknummer(): ?string
    {
        return $this->Schranknummer;
    }

    public function setSchranknummer(string $Schranknummer): static
    {
        $this->Schranknummer = $Schranknummer;

        return $this;
    }

    /**
     * @return Collection<int, Mikroskop>
     */
    public function getMikroskope(): Collection
    {
        return $this->mikroskope;
    }

    public function addMikroskope(Mikroskop $mikroskope): static
    {
        if (!$this->mikroskope->contains($mikroskope)) {
            $this->mikroskope->add($mikroskope);
            $mikroskope->setLagerort($this);
        }

        return $this;
    }

    public function removeMikroskope(Mikroskop $mikroskope): static
    {
        if ($this->mikroskope->removeElement($mikroskope)) {
            // set the owning side to null (unless already changed)
            if ($mikroskope->getLagerort() === $this) {
                $mikroskope->setLagerort(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getKurzbeschreibung();
    }
}
