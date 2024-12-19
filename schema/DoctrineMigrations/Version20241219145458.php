<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20241219145458 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Changed mediaRelaySetId to nullable in Carriers and DDIProviders';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Carriers CHANGE mediaRelaySetId mediaRelaySetId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIProviders CHANGE mediaRelaySetId mediaRelaySetId INT UNSIGNED DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Carriers CHANGE mediaRelaySetId mediaRelaySetId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE DDIProviders CHANGE mediaRelaySetId mediaRelaySetId INT UNSIGNED NOT NULL');
    }
}