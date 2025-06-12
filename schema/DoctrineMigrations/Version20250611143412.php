<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20250611145118 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added disableDiversion into OutgoingRouting';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE OutgoingRouting ADD disableDiversion TINYINT(1) DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE OutgoingRouting DROP disableDiversion');
    }
}
