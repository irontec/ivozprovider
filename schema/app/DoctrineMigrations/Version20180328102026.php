<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180328102026 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Check if delta 079-disable-cfw.sql is already applied
        $deltaApplied = $this->connection->query('SELECT 1 FROM changelog WHERE change_number = 79')->rowCount();
        if ($deltaApplied) {
            $this->connection->query('DELETE FROM changelog WHERE change_number = 79')->execute();
            return;
        }

        $this->addSql('DROP INDEX callFwTypeUser ON CallForwardSettings');
        $this->addSql('ALTER TABLE CallForwardSettings ADD enabled TINYINT(1) unsigned DEFAULT \'1\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallForwardSettings DROP enabled');
        $this->addSql('CREATE UNIQUE INDEX callFwTypeUser ON CallForwardSettings (callForwardType, userId, callTypeFilter)');
    }
}
