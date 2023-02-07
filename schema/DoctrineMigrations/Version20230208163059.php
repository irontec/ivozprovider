<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208163059 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Remove externallyRated from Carriers and DDIProviders';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Carriers DROP externallyRated');
        $this->addSql('ALTER TABLE DDIProviders DROP externallyRated');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Carriers ADD externallyRated TINYINT(1) DEFAULT 0');
        $this->addSql('ALTER TABLE DDIProviders ADD externallyRated TINYINT(1) DEFAULT 0');
    }
}
