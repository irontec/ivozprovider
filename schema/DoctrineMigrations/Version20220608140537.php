<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220608140537 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add DisplayName to IVREntries';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE IVREntries ADD displayName VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE IVREntries DROP displayName');
    }
}
