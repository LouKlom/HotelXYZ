<?php

// src/Service/ChambreServiceInterface.php

namespace App\Service;

use App\Entity\Chambre;

interface ChambreServiceInterface
{
    public function creerChambreStandard(): array;
    public function creerChambreSuperieur(): array;
    public function creerSuite(): array;
    public function listerChambres(): array;
    public function deleteChambre(int $chambre): void;
}
