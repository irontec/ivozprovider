<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version00000000000000 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Remove imported migration information from previous releases';
    }

    public function up(Schema $schema): void
    {
        // Delete IvozProvider 1.x migrations tracking table
        $this->addSql("DROP TABLE IF EXISTS changelog");
        // Update IvozProvider 2.x migrations tracking records
        $this->addSql("UPDATE migration_versions SET version=CONCAT('Application\\\\Migrations\\\\Version', version) WHERE version NOT LIKE 'Application%'");
        $this->addSql("UPDATE migration_versions SET executed_at = FROM_UNIXTIME(0)");
    }

    public function down(Schema $schema): void
    {
    }
}
