<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $AdresseMail = null;

    #[ORM\Column(length: 255)]
    private ?string $MotdePasse = null;

    #[ORM\Column(length: 15)]
    private ?string $Telephone = null;

    #[ORM\Column(length: 10)]
    private ?string $Identifianthotel = null;

    /**
     * @ORM\Column(name="portefeuille_id", type="integer", nullable=true)
     */
    private $portefeuilleId;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="client")
     */
    private $reservations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->AdresseMail;
    }

    public function setAdresseMail(string $AdresseMail): static
    {
        $this->AdresseMail = $AdresseMail;

        return $this;
    }

    public function getMotdePasse(): ?string
    {
        return $this->MotdePasse;
    }

    public function setMotdePasse(string $MotdePasse): static
    {
        $this->MotdePasse = $MotdePasse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): static
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getIdentifianthotel(): ?string
    {
        return $this->Identifianthotel;
    }

    public function setIdentifianthotel(string $Identifianthotel): static
    {
        $this->Identifianthotel = $Identifianthotel;

        return $this;
    }

    public function getPortefeuilleId(): ?int
    {
        return $this->portefeuilleId;
    }

    public function setPortefeuilleId(?int $portefeuilleId): self
    {
        $this->portefeuilleId = $portefeuilleId;

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
            $reservation->setClient($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getClient() === $this) {
                $reservation->setClient(null);
            }
        }

        return $this;
    }
}
