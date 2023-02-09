<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220603094200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Set ApplicationServers name not nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ApplicationServers CHANGE name name VARCHAR(64) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ApplicationServers CHANGE name name VARCHAR(64) DEFAULT NULL');
    }
}
