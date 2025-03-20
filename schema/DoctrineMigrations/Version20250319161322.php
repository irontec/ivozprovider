<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250319161322 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'New field billableCallId in Recordings';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Recordings ADD billableCallId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Recordings ADD CONSTRAINT FK_A68A9FBE2645DA94 FOREIGN KEY (billableCallId) REFERENCES BillableCalls (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A68A9FBE2645DA94 ON Recordings (billableCallId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Recordings DROP FOREIGN KEY FK_A68A9FBE2645DA94');
        $this->addSql('DROP INDEX IDX_A68A9FBE2645DA94 ON Recordings');
        $this->addSql('ALTER TABLE Recordings DROP billableCallId');
    }
}