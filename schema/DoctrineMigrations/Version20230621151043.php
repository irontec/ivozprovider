<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621151043 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Fixed default value of MediaRelaySets';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE MediaRelaySets CHANGE name name VARCHAR(32) DEFAULT \'\' NOT NULL');
        $this->addSql("UPDATE MediaRelaySets SET name = '' WHERE name = '0'");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE MediaRelaySets CHANGE name name VARCHAR(32) DEFAULT \'0\' NOT NULL');
    }
}
