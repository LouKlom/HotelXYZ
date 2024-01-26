<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240121122607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_CLIENT_PORTEFEUILLE');
        $this->addSql('DROP INDEX FK_CLIENT_PORTEFEUILLE ON client');
        $this->addSql('ALTER TABLE client DROP portefeuille_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD portefeuille_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_CLIENT_PORTEFEUILLE FOREIGN KEY (portefeuille_id) REFERENCES portefeuille (id)');
        $this->addSql('CREATE INDEX FK_CLIENT_PORTEFEUILLE ON client (portefeuille_id)');
    }
}
