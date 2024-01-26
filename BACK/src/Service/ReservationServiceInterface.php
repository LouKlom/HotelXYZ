<?php

// src/Service/ReservationServiceInterface.php

namespace App\Service;

interface ReservationServiceInterface
{
    public function creerReservation(int $clientId, int $portefeuilleId, int $chambreId, string $dateDebut, string $dateFin, int $prixChambre): void;
    public function getReservationsByClientId(int $clientId): array;
}
