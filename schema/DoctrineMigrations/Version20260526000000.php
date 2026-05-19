<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20260526000000 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add callDirection field to Webhooks table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE Webhooks ADD callDirection VARCHAR(25) DEFAULT 'both' NOT NULL COMMENT '[enum:inbound|outbound|both]'");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Webhooks DROP callDirection');
    }
}
