<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124094754 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Fix default value of Queue.announcePosition';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE Queues CHANGE announcePosition announcePosition VARCHAR(10) DEFAULT 'no' COMMENT '[enum:yes|no]'");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("ALTER TABLE Queues CHANGE announcePosition announcePosition VARCHAR(10) DEFAULT NULL COMMENT '[enum:yes|no]'");
    }
}
