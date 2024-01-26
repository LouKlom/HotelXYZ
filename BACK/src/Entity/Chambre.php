<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChambreRepository::class)]
class Chambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Type = null;

    #[ORM\Column]
    private ?int $Prix = null;

    #[ORM\Column]
    private ?bool $Wifi = null;

    #[ORM\Column]
    private ?bool $TV = null;

    #[ORM\Column]
    private ?bool $Tvecranplat = null;

    #[ORM\Column]
    private ?bool $lituneplace = null;

    #[ORM\Column]
    private ?bool $litdeuxplaces = null;

    #[ORM\Column]
    private ?bool $Minibar = null;

    #[ORM\Column]
    private ?bool $Climatiseur = null;

    #[ORM\Column]
    private ?bool $Baignoire = null;

    #[ORM\Column]
    private ?bool $Terrasse = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="chambre")
     */
    private $reservations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): static
    {
        $this->Type = $Type;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function isWifi(): ?bool
    {
        return $this->Wifi;
    }

    public function setWifi(bool $Wifi): static
    {
        $this->Wifi = $Wifi;

        return $this;
    }

    public function isTV(): ?bool
    {
        return $this->TV;
    }

    public function setTV(bool $TV): static
    {
        $this->TV = $TV;

        return $this;
    }

    public function isTvecranplat(): ?bool
    {
        return $this->Tvecranplat;
    }

    public function setTvecranplat(bool $Tvecranplat): static
    {
        $this->Tvecranplat = $Tvecranplat;

        return $this;
    }

    public function isLituneplace(): ?bool
    {
        return $this->lituneplace;
    }

    public function setLituneplace(bool $lituneplace): static
    {
        $this->lituneplace = $lituneplace;

        return $this;
    }

    public function isLitdeuxplaces(): ?bool
    {
        return $this->litdeuxplaces;
    }

    public function setLitdeuxplaces(bool $litdeuxplaces): static
    {
        $this->litdeuxplaces = $litdeuxplaces;

        return $this;
    }

    public function isMinibar(): ?bool
    {
        return $this->Minibar;
    }

    public function setMinibar(bool $Minibar): static
    {
        $this->Minibar = $Minibar;

        return $this;
    }

    public function isClimatiseur(): ?bool
    {
        return $this->Climatiseur;
    }

    public function setClimatiseur(bool $Climatiseur): static
    {
        $this->Climatiseur = $Climatiseur;

        return $this;
    }

    public function isBaignoire(): ?bool
    {
        return $this->Baignoire;
    }

    public function setBaignoire(bool $Baignoire): static
    {
        $this->Baignoire = $Baignoire;

        return $this;
    }

    public function isTerrasse(): ?bool
    {
        return $this->Terrasse;
    }

    public function setTerrasse(bool $Terrasse): static
    {
        $this->Terrasse = $Terrasse;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setChambre($this);
        }

        return $this;
    }

}
