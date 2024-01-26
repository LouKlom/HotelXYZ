<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105192401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, prix INT NOT NULL, wifi TINYINT(1) NOT NULL, tv TINYINT(1) NOT NULL, tvecranplat TINYINT(1) NOT NULL, lituneplace TINYINT(1) NOT NULL, litdeuxplaces TINYINT(1) NOT NULL, minibar TINYINT(1) NOT NULL, climatiseur TINYINT(1) NOT NULL, baignoire TINYINT(1) NOT NULL, terrasse TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse_mail VARCHAR(255) NOT NULL, motde_passe VARCHAR(255) NOT NULL, telephone VARCHAR(15) NOT NULL, identifianthotel VARCHAR(10) NOT NULL, portefeuille_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portefeuille (id INT AUTO_INCREMENT NOT NULL, solde INT DEFAULT NULL, devise VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, datefin DATE NOT NULL, validationpayement TINYINT(1) NOT NULL, payementconfirme TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
   
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_CLIENT_PORTEFEUILLE FOREIGN KEY (portefeuille_id) REFERENCES portefeuille (id)');
        $this->addSql('SET foreign_key_checks = 1;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE portefeuille');
        $this->addSql('DROP TABLE reservation');
    }
}
