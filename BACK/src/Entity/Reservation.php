<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Datefin = null;

    #[ORM\Column]
    private ?bool $Validationpayement = null;

    #[ORM\Column]
    private ?bool $payementconfirme = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chambre", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chambre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?int $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->DateDebut;
    }

    public function setDateDebut(\DateTimeInterface $DateDebut): static
    {
        $this->DateDebut = $DateDebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->Datefin;
    }

    public function setDatefin(\DateTimeInterface $Datefin): static
    {
        $this->Datefin = $Datefin;

        return $this;
    }

    public function isValidationpayement(): ?bool
    {
        return $this->Validationpayement;
    }

    public function setValidationpayement(bool $Validationpayement): static
    {
        $this->Validationpayement = $Validationpayement;

        return $this;
    }

    public function isPayementconfirme(): ?bool
    {
        return $this->payementconfirme;
    }

    public function setPayementconfirme(bool $payementconfirme): static
    {
        $this->payementconfirme = $payementconfirme;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?int $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }


}
