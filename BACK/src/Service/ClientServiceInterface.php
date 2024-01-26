<?php

// src/Service/ClientServiceInterface.php
namespace App\Service;

interface ClientServiceInterface
{
    public function createClient(array $data): array;
    public function getClient(int $clientId): ?array;
    public function updateClient(int $clientId, array $data): void;
    public function deleteClient(int $clientId): void;
    public function seConnecter(array $data): array;
}