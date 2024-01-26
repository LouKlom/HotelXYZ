<?php

namespace App\Tests\Entity;

use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $client = new Client();

        // Test setters and getters
        $client->setNom('Doe');
        $this->assertEquals('Doe', $client->getNom());

        $client->setPrenom('John');
        $this->assertEquals('John', $client->getPrenom());

        $client->setAdresseMail('john.doe@example.com');
        $this->assertEquals('john.doe@example.com', $client->getAdresseMail());

        $client->setMotdePasse('secure_password');
        $this->assertEquals('secure_password', $client->getMotdePasse());

        $client->setTelephone('123456789');
        $this->assertEquals('123456789', $client->getTelephone());

        $client->setIdentifianthotel('hotel123');
        $this->assertEquals('hotel123', $client->getIdentifianthotel());

        $client->setPortefeuilleId(1);
        $this->assertEquals(1, $client->getPortefeuilleId());
    }

    public function testReservations()
    {
        $client = new Client();
        $reservation = new \App\Entity\Reservation();

        // Test adding reservation
        $client->addReservation($reservation);
        $this->assertCount(1, $client->getReservations());
        $this->assertSame($client, $reservation->getClient());

        // Test removing reservation
        $client->removeReservation($reservation);
        $this->assertCount(0, $client->getReservations());
        $this->assertNull($reservation->getClient());
    }
}
