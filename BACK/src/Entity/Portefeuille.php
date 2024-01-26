<?php

namespace App\Entity;

use App\Repository\PortefeuilleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortefeuilleRepository::class)]
class Portefeuille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Solde = null;

    #[ORM\Column(length: 255)]
    private ?string $devise = null;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Client", inversedBy="portefeuille")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSolde(): ?int
    {
        return $this->Solde;
    }

    public function setSolde(?int $Solde): static
    {
        $this->Solde = $Solde;

        return $this;
    }

    public function getDevise(): ?string
    {
        return $this->devise;
    }

    public function setDevise(string $devise): static
    {
        $this->devise = $devise;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

}
