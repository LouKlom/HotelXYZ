<?php

// src/Controller/ReservationController.php

namespace App\Controller;

use App\Service\ReservationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    private $reservationService;

    public function __construct(ReservationServiceInterface $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function creerReservation(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $this->reservationService->creerReservation(
            $data['clientId'],
            $data['portefeuilleId'],
            $data['chambreId'],
            $data['dateDebut'],
            $data['dateFin'],
            $data['prixChambre']
        );

        return $this->json(['message' => 'Réservation créée'], 201);
    }

    public function getReservationsByClientId(int $clientId): JsonResponse
    {
        $reservations = $this->reservationService->getReservationsByClientId($clientId);
        
        return $this->json($reservations);
    }
}
