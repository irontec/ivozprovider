<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240126121409 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add ProxyTrunks.advertisedIp column';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ProxyTrunks ADD advertisedIp VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ProxyTrunks DROP advertisedIp');
    }
}
