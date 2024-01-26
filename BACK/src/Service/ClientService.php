<?php

// src/Service/ClientService.php
namespace App\Service;

use App\Entity\Client;
use App\Entity\Portefeuille;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;

class ClientService implements ClientServiceInterface
{
    private $entityManager;
    private Connection $connection;

    public function __construct(EntityManagerInterface $entityManager, Connection $connection)
    {
        $this->entityManager = $entityManager;
        $this->connection = $connection;
    }

    public function createClient(array $data): array
    {
        // Création du client
        $client = new Client();
        $client->setNom($data['nom']);
        $client->setPrenom($data['prenom']);
        $client->setAdresseMail($data['email']);
        $client->setTelephone($data['telephone']);
        $client->setMotdePasse($data['password']);

        // Génération HotelID
        $hotelID = $this->genererHotelId();
        $client->setIdentifianthotel($hotelID);

        // Création du portefeuille
        $portefeuille = new Portefeuille();
        $portefeuille->setSolde(0);
        $portefeuille->setDevise($data['devise']);

        $this->entityManager->persist($portefeuille);
        $this->entityManager->flush();

        // Associer l'ID du portefeuille au client
        $client->setPortefeuilleId($portefeuille->getId());

        // Persist et flush le client
        $this->entityManager->persist($client);
        $this->entityManager->flush();

        // Mettre à jour la colonne portefeuille_id dans la table client
        $this->updateClientPortefeuilleId($client->getId(), $portefeuille->getId());

        return ['hotelId' => $hotelID, 'portID' => $portefeuille->getId()];
    }
    
    private function updateClientPortefeuilleId(int $clientId, int $portefeuilleId): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder
            ->update('client')
            ->set('portefeuille_id', ':portefeuilleId')
            ->where('id = :clientId')
            ->setParameter('portefeuilleId', $portefeuilleId)
            ->setParameter('clientId', $clientId);

        $queryBuilder->execute();
    }

    public function getClient(int $clientId): ?array
    {
        $client = $this->entityManager->getRepository(Client::class)->find($clientId);

        if (!$client) {
            return null;
        }

        $queryBuilder = $this->connection->createQueryBuilder();

        $selectQueryBuilder = $this->connection->createQueryBuilder();

        $selectQueryBuilder
            ->select('portefeuille_id')
            ->from('client')
            ->where('id = :clientId')
            ->setParameter('clientId', $clientId);
        
        $PortefeuilleId = $selectQueryBuilder->execute()->fetchOne();


        return [
            'id' => $client->getId(),
            'nom' => $client->getNom(),
            'prenom' => $client->getPrenom(),
            'email' => $client->getAdresseMail(),
            'telephone' => $client->getTelephone(),
            'portefeuilleid' => $PortefeuilleId,
        ];
    }

    public function updateClient(int $clientId, array $data): void
    {
        $client = $this->entityManager->getRepository(Client::class)->find($clientId);

        if ($client) {
            $client->setNom($data['nom']);
            $client->setPrenom($data['prenom']);
            $client->setAdresseMail($data['email']);
            $client->setTelephone($data['telephone']);

            $this->entityManager->flush();
        }
    }

    public function deleteClient(int $clientId): void
    {
        $client = $this->entityManager->getRepository(Client::class)->find($clientId);

        if ($client) {
            $this->entityManager->remove($client);
            $this->entityManager->flush();
        }
    }

    private function genererHotelId(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hotelId = '';

        for ($i = 0; $i < 10; $i++) {
            $hotelId .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $hotelId;
    }




    public function seConnecter(array $data): array
    {
        $hotelID = $data['hotelID'] ?? null;
        $motDePasse = $data['motdepasse'] ?? null;
    
        if (!$hotelID || !$motDePasse) {
            return ['success' => false];
        }
    
        $client = $this->entityManager->getRepository(Client::class)->findOneBy(['Identifianthotel' => $hotelID]);
    
        if ($client && $motDePasse === $client->getMotdePasse()) {
            return ['success' => true, 'clientId' => $client->getId()];
        }
    
        return ['success' => false];
    }
}
