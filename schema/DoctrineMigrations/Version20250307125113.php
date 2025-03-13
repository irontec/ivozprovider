<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20250307125113 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add Recordings-UsersCdr FK and UsersCdrs.numRecordings';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Recordings ADD usersCdrId INT UNSIGNED DEFAULT NULL');
        $this->addSql('
            ALTER TABLE Recordings
            ADD CONSTRAINT FK_A68A9FBEC38866F6 
                FOREIGN KEY (usersCdrId)
                REFERENCES UsersCdrs (id) ON DELETE SET NULL
        ');
        $this->addSql('CREATE INDEX IDX_A68A9FBEC38866F6 ON Recordings (usersCdrId)');
        $this->addSql('ALTER TABLE UsersCdrs ADD numRecordings INT UNSIGNED DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Recordings DROP FOREIGN KEY FK_A68A9FBEC38866F6');
        $this->addSql('DROP INDEX IDX_A68A9FBEC38866F6 ON Recordings');
        $this->addSql('ALTER TABLE Recordings DROP usersCdrId');
        $this->addSql('ALTER TABLE UsersCdrs DROP numRecordings');
    }
}