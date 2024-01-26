<?php 

// src/Controller/ClientController.php
namespace App\Controller;

use App\Service\ClientServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends AbstractController
{
    private $clientService;

    public function __construct(ClientServiceInterface $clientService)
    {
        $this->clientService = $clientService;
    }

    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $response = $this->clientService->createClient($data);

        return $this->json($response, 201);
    }

    public function read(int $clientId): JsonResponse
    {
        $client = $this->clientService->getClient($clientId);

        if (!$client) {
            return $this->json(['message' => 'Client innexistant'], 404);
        }
    
        return $this->json($client);
    }

    public function update(Request $request, int $clientId): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->clientService->updateClient($clientId, $data);
    
        return $this->json(['message' => 'Client mis à jour']); 
    }

    public function delete(int $clientId): JsonResponse
    {
        $this->clientService->deleteClient($clientId);

        return $this->json(['message' => 'Client supprimé']);
    }

    public function seConnecter(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $resultat = $this->clientService->seConnecter($data);

        return $this->json(['resultat' => $resultat]);
    }
}
