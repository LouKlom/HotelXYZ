<?php

// src/Controller/ChambreController.php

namespace App\Controller;

use App\Service\ChambreServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ChambreController extends AbstractController
{
    private $chambreService;

    public function __construct(ChambreServiceInterface $chambreService)
    {
        $this->chambreService = $chambreService;
    }

    public function creerChambreStandard(): JsonResponse
    {
        $standardId = $this->chambreService->creerChambreStandard()['id'];

        return $this->json(['message' => 'Chambre créée', 'id' => $standardId]);
    }

    public function creerChambreSuperieur(): JsonResponse
    {
        $superieurId = $this->chambreService->creerChambreSuperieur()['id'];

        return $this->json(['message' => 'Chambre créée', 'id' => $superieurId]);
    }

    public function creerSuite(): JsonResponse
    {
        $suiteId = $this->chambreService->creerSuite()['id'];

        return $this->json(['message' => 'Suite créée', 'id' => $suiteId]);
    }

    public function listerChambres(): JsonResponse
    {
        $chambres = $this->chambreService->listerChambres();

        return $this->json($chambres);
    }


    public function deleteChambre(int $chambre): JsonResponse
    {
        $this->chambreService->deleteChambre($chambre);

        return $this->json(['message' => 'Chambre supprimée']);
    }

}
