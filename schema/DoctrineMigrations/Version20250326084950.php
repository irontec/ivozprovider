<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20250326084950 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add Recordings-BillableCall FK and BillableCalls.numRecordings';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Recordings ADD billableCallId INT UNSIGNED DEFAULT NULL');
        $this->addSql('
            ALTER TABLE Recordings 
            ADD CONSTRAINT FK_A68A9FBE2645DA94 
                FOREIGN KEY (billableCallId) 
                REFERENCES BillableCalls (id) ON DELETE SET NULL
        ');
        $this->addSql('CREATE INDEX IDX_A68A9FBE2645DA94 ON Recordings (billableCallId)');
        $this->addSql('ALTER TABLE BillableCalls ADD numRecordings INT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE BillableCallHistorics ADD numRecordings INT UNSIGNED DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Recordings DROP FOREIGN KEY FK_A68A9FBE2645DA94');
        $this->addSql('DROP INDEX IDX_A68A9FBE2645DA94 ON Recordings');
        $this->addSql('ALTER TABLE Recordings DROP billableCallId');
        $this->addSql('ALTER TABLE BillableCalls DROP numRecordings');
        $this->addSql('ALTER TABLE BillableCallHistorics DROP numRecordings');
    }
}
