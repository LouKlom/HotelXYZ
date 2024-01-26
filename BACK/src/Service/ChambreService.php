<?php 

// src/Service/ChambreService.php

namespace App\Service;

use App\Entity\Chambre;
use Doctrine\ORM\EntityManagerInterface;

class ChambreService implements ChambreServiceInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function creerChambreStandard(): array
    {
        $chambre = new Chambre();
        $chambre->setType("Chambre standard");
        $chambre->setPrix(50);
        $chambre->setWifi(1);
        $chambre->setTV(1);
        $chambre->setTvecranplat(0);
        $chambre->setLituneplace(1);
        $chambre->setLitdeuxplaces(0);
        $chambre->setMinibar(0);
        $chambre->setClimatiseur(0);
        $chambre->setBaignoire(0);
        $chambre->setTerrasse(0);

        $this->entityManager->persist($chambre);
        $this->entityManager->flush();

        $standardId = $chambre->getId();

        return ['id' => $standardId];
    }

    public function creerChambreSuperieur(): array
    {
        $chambre = new Chambre();
        $chambre->setType("Chambre superieur");
        $chambre->setPrix(100);
        $chambre->setWifi(1);
        $chambre->setTV(0);
        $chambre->setTvecranplat(1);
        $chambre->setLituneplace(0);
        $chambre->setLitdeuxplaces(1);
        $chambre->setMinibar(1);
        $chambre->setClimatiseur(1);
        $chambre->setBaignoire(0);
        $chambre->setTerrasse(0);

        $this->entityManager->persist($chambre);
        $this->entityManager->flush();

        $superieurId = $chambre->getId();

        return ['id' => $superieurId];
    }

    public function creerSuite(): array
    {
        $chambre = new Chambre();
        $chambre->setType("Suite");
        $chambre->setPrix(200);
        $chambre->setWifi(1);
        $chambre->setTV(0);
        $chambre->setTvecranplat(1);
        $chambre->setLituneplace(0);
        $chambre->setLitdeuxplaces(1);
        $chambre->setMinibar(1);
        $chambre->setClimatiseur(1);
        $chambre->setBaignoire(1);
        $chambre->setTerrasse(1);

        $this->entityManager->persist($chambre);
        $this->entityManager->flush();

        $suiteId = $chambre->getId();
        $prix = $chambre->getPrix();

        return ['id' => $suiteId, 'prix' => $prix];
    }

    public function listerChambres(): array
    {
        return $this->entityManager->getRepository(Chambre::class)->findAll();
    }



    public function deleteChambre(int $chambre): void
    {
        $chambre = $this->entityManager->getRepository(Chambre::class)->find($chambre);

        if ($chambre) {
            $this->entityManager->remove($chambre);
            $this->entityManager->flush();
        }
    }
}
