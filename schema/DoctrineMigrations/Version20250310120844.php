<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20250310120844 extends LoggableMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Companies ADD locationId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE
          Companies
        ADD
          CONSTRAINT FK_B5289996D7286D FOREIGN KEY (locationId) REFERENCES Locations (id) ON DELETE
        SET
          NULL');
        $this->addSql('CREATE INDEX IDX_B5289996D7286D ON Companies (locationId)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B5289996D7286D');
        $this->addSql('DROP INDEX IDX_B5289996D7286D ON Companies');
        $this->addSql('ALTER TABLE Companies DROP locationId');
    }
}
