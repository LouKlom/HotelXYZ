<?php

// src/Service/ReservationService.php

namespace App\Service;

use App\Entity\Chambre;
use App\Entity\Client;
use App\Entity\Portefeuille;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Query\QueryBuilder;

class ReservationService implements ReservationServiceInterface
{
    private $entityManager;
    private $portefeuilleService;
    private Connection $connection;

    public function __construct(EntityManagerInterface $entityManager, PortefeuilleServiceInterface $portefeuilleService, Connection $connection)
    {
        $this->entityManager = $entityManager;
        $this->portefeuilleService = $portefeuilleService;
        $this->connection = $connection;
    }

    public function creerReservation(int $clientId, int $portefeuilleId, int $chambreId, string $dateDebut, string $dateFin, int $prixChambre): void
    {
        $client = $this->entityManager->getRepository(Client::class)->find($clientId);
        $chambre = $this->entityManager->getRepository(Chambre::class)->find($chambreId);
        $portefeuille = $this->entityManager->getRepository(Portefeuille::class)->find($portefeuilleId);
    
        $soldePortefeuille = $this->getSoldePortefeuilleById($portefeuilleId);
        
        if ($soldePortefeuille !== null && $soldePortefeuille >= ($prixChambre / 2)) {
            $this->portefeuilleService->debiterPortefeuille($portefeuilleId, $prixChambre / 2);
    
            $reservation = new Reservation();
            $reservation->setDateDebut(new \DateTime($dateDebut));
            $reservation->setDateFin(new \DateTime($dateFin));
            $reservation->setValidationpayement(1);
            $reservation->setPayementconfirme(false);
    
            $this->entityManager->persist($reservation);
            $this->entityManager->flush();

            $this->updateReservationClientId($reservation->getId(), $clientId);
            $this->updateReservationChambreId($reservation->getId(), $chambreId);

        } else {
            
        }
    }

    public function getReservationsByClientId(int $clientId): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder
            ->select('*')
            ->from('reservation')
            ->where('id_client = :clientId')
            ->setParameter('clientId', $clientId);

        $statement = $queryBuilder->execute();
            
        $reservations = $statement->fetchAllAssociative();

        return $reservations;
    }

    private function updateReservationClientId(int $reservationId, int $clientId): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();
    
        $queryBuilder
            ->update('reservation')
            ->set('id_client', ':clientId')
            ->where('id = :reservationId')
            ->setParameter('clientId', $clientId)
            ->setParameter('reservationId', $reservationId);
    
        $queryBuilder->execute();
    }
    
    private function updateReservationChambreId(int $reservationId, int $chambreId): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();
    
        $queryBuilder
            ->update('reservation')
            ->set('chambre_id', ':chambreId')
            ->where('id = :reservationId')
            ->setParameter('chambreId', $chambreId)
            ->setParameter('reservationId', $reservationId);
    
        $queryBuilder->execute();
    }
    

    public function getSoldePortefeuilleById(int $portefeuilleId): ?int
    {
        $portefeuilleRepository = $this->entityManager->getRepository(Portefeuille::class);
        $portefeuille = $portefeuilleRepository->find($portefeuilleId);

        if (!$portefeuille) {
            return null; 
        }
        
        return $portefeuille->getSolde();
    }
}
