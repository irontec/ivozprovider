<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20250708090202 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add productName column to WebPortals table with default value "Ivoz Provider"';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE WebPortals ADD productName VARCHAR(64) DEFAULT \'Ivoz Provider\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE WebPortals DROP productName');
    }
}