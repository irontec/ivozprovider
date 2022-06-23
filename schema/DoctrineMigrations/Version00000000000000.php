<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version00000000000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove imported migration information from previous releases';
    }

    public function up(Schema $schema): void
    {
        // Delete IvozProvider 1.x migrations tracking table
        $this->addSql("DROP TABLE IF EXISTS changelog");
        // Delete IvozProvider 2.x migrations tracking records
        $this->addSql("DELETE FROM migration_versions");
    }

    public function down(Schema $schema): void
    {
    }
}
