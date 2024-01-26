<?php
// src/Service/PortefeuilleService.php

namespace App\Service;

use App\Entity\Client;
use App\Entity\Portefeuille;
use Doctrine\ORM\EntityManagerInterface;

class PortefeuilleService implements PortefeuilleServiceInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function crediterPortefeuille(int $portefeuilleId, int $montant): void
    {
        $portefeuille = $this->entityManager->getRepository(Portefeuille::class)->find($portefeuilleId);

        if (!$portefeuille) {
            
            return;
        }

        $nouveauSolde = $portefeuille->getSolde() + $montant;
        $portefeuille->setSolde($nouveauSolde);

        $this->entityManager->flush();
    }


    public function debiterPortefeuille(int $portefeuilleId, int $montant): void
    {
        $portefeuille = $this->entityManager->getRepository(Portefeuille::class)->find($portefeuilleId);

        if (!$portefeuille) {
            
            return;
        }

        $nouveauSolde = $portefeuille->getSolde() - $montant;
        $portefeuille->setSolde($nouveauSolde);

        $this->entityManager->flush();
    }

    public function getPortefeuille(int $portefeuilleId): ?array
    {
        $portefeuille = $this->entityManager->getRepository(Portefeuille::class)->find($portefeuilleId);
    
        if(!$portefeuille) {
            return null;
        }

        return [
            'id' => $portefeuille->getId(),
            'solde' => $portefeuille->getSolde(),
            'devise' => $portefeuille->getDevise(),
        ];
    }

    // Obsolète, ne pas enlever sans risquer de péter le code
    public function creerPortefeuille(Client $client): void
    {
        $portefeuille = new Portefeuille();
        $portefeuille->setClient($client);
        $portefeuille->setSolde(0);
        $portefeuille->setDevise("EUR");

        $this->entityManager->persist($portefeuille);
        $this->entityManager->flush();
    }
}
