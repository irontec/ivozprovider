<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20250331110602 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add Users.useDefaultLocation';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Users ADD useDefaultLocation TINYINT(1) DEFAULT 1 NOT NULL');

        $this->addSql('UPDATE Users SET useDefaultLocation = 1 WHERE locationId IS NULL');
        $this->addSql('
            UPDATE Users u
            INNER JOIN Companies c ON u.companyId= c.id
            SET u.locationId = c.locationId
            WHERE u.useDefaultLocation = 1
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Users DROP useDefaultLocation');
    }
}
