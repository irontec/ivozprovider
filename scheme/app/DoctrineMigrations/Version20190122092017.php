<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190122092017 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_cdrs CHANGE metered parsed TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD parserScheduledAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\' AFTER `parsed`');

        $this->addSql('CREATE INDEX trunksCdr_parsed_idx ON kam_trunks_cdrs (parsed)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('DROP INDEX trunksCdr_parsed_idx ON kam_trunks_cdrs');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP parserScheduledAt, CHANGE parsed metered TINYINT(1) DEFAULT \'0\'');
    }
}
