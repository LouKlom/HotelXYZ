<?php 
// src/Controller/PortefeuilleController.php
namespace App\Controller;

use App\Service\PortefeuilleServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PortefeuilleController extends AbstractController
{
    private $portefeuilleService;

    public function __construct(PortefeuilleServiceInterface $portefeuilleService)
    {
        $this->portefeuilleService = $portefeuilleService;
    }

    public function crediter(Request $request, int $portefeuilleId): JsonResponse
    {
        $montant = (int)$request->getContent();

        $this->portefeuilleService->crediterPortefeuille($portefeuilleId, $montant);

        return $this->json(['message' => 'Argent crédité avec succès.']);
    }

    public function debiter(Request $request, int $portefeuilleId): JsonResponse
    {
        $montant = (int)$request->getContent();

        $this->portefeuilleService->debiterPortefeuille($portefeuilleId, $montant);

        return $this->json(['message' => 'Argent débité avec succès.']);
    }

    public function creer(Request $request, int $clientId): JsonResponse
    {
        $this->portefeuilleService->creerPortefeuille($clientId);

        return $this->json(['message' => 'Portefeuille créé avec succès.']);
    }

    public function getPortefeuille(int $portefeuilleId): JsonResponse
    {
        $portefeuille = $this->portefeuilleService->getPortefeuille($portefeuilleId);

        if (!$portefeuille) {
            return $this->json(['message' => 'Portefeuille introuvable'], 404);
        }


        return $this->json($portefeuille);
    }
}
