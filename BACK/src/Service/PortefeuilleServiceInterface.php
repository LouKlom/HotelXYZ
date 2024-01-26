<?php

// src/Service/PortefeuilleServiceInterface.php

namespace App\Service;

use App\Entity\Portefeuille;
use App\Entity\Client;

interface PortefeuilleServiceInterface
{
    public function crediterPortefeuille(int $portefeuille, int $montant): void;

    public function debiterPortefeuille(int $portefeuille, int $montant): void;

    public function getPortefeuille(int $portefeuille): ?array;

    public function creerPortefeuille(Client $client): void;
}