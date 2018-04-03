<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180308143534 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Check if delta 080-ringall-missed-calls.sql is already applied
        $deltaApplied = $this->connection->query('SELECT 1 FROM changelog WHERE change_number = 80')->rowCount();
        if ($deltaApplied) {
            $this->connection->query('DELETE FROM changelog WHERE change_number = 80')->execute();
            return;
        }

        $this->addSql("ALTER TABLE HuntGroups ADD preventMissedCalls int(10) unsigned NOT NULL DEFAULT '1'");
        $this->addSql("UPDATE HuntGroups SET preventMissedCalls = 0 WHERE strategy != 'ringAll'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE HuntGroups DROP preventMissedCalls');
    }
}
