<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250324094453 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'new enumeration type field survivalDeviceId in Locations';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Locations ADD survivalDeviceId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Locations ADD CONSTRAINT FK_9517C819282B7B61 FOREIGN KEY (survivalDeviceId) REFERENCES SurvivalDevices (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_9517C819282B7B61 ON Locations (survivalDeviceId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Locations DROP FOREIGN KEY FK_9517C819282B7B61');
        $this->addSql('DROP INDEX IDX_9517C819282B7B61 ON Locations');
        $this->addSql('ALTER TABLE Locations DROP survivalDeviceId');
    }
}