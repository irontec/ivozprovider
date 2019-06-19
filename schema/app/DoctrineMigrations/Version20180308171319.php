<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180308171319 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Check if delta 078-brand-maxcalls.sql is already applied
        $deltaApplied = $this->connection->query('SELECT 1 FROM changelog WHERE change_number = 78')->rowCount();
        if ($deltaApplied) {
            $this->connection->query('DELETE FROM changelog WHERE change_number = 78')->execute();
            return;
        }
        $this->addSql("ALTER TABLE Brands ADD maxCalls int(10) unsigned NOT NULL DEFAULT '0'");
        $this->addSql("ALTER TABLE Companies CHANGE externalmaxcalls maxCalls int(10) unsigned NOT NULL DEFAULT '0'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands DROP maxCalls');
        $this->addSql('ALTER TABLE Companies CHANGE maxCalls externalMaxCalls INT UNSIGNED DEFAULT 0 NOT NULL');
    }
}
