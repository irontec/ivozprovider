<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403134545 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add canImpersonate to Administrators';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Administrators ADD canImpersonate TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('UPDATE Administrators SET canImpersonate = 1 WHERE restricted = 0');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Administrators DROP canImpersonate');
    }
}
