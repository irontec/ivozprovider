<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20260604114645 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Enable Webhooks Feature for client';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE PublicEntities SET client = 1 WHERE iden = "Webhooks"');
        $this->addSql('ALTER TABLE Webhooks ADD userId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE
          Webhooks
        ADD
          CONSTRAINT FK_60FA2D8B64B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_60FA2D8B64B64DCC ON Webhooks (userId)');
        $this->addSql('ALTER TABLE Webhooks ADD eventUpdateClid TINYINT(1) DEFAULT 0 NOT NULL');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE PublicEntities SET client = 0 WHERE iden = "Webhooks"');
        $this->addSql('ALTER TABLE Webhooks DROP FOREIGN KEY FK_60FA2D8B64B64DCC');
        $this->addSql('DROP INDEX IDX_60FA2D8B64B64DCC ON Webhooks');
        $this->addSql('ALTER TABLE Webhooks DROP userId');
        $this->addSql('ALTER TABLE Webhooks DROP eventUpdateClid');
    }
}
