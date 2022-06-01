<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20220207084804 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Avoid duplicated Url Patterns in TerminalModels table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX terminalModel_genericUrlPattern ON TerminalModels (genericUrlPattern)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX terminalModel_genericUrlPattern ON TerminalModels');
    }
}
