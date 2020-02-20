<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180529165016 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE PeerServers CHANGE uri_scheme uri_scheme SMALLINT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways CHANGE uri_scheme uri_scheme SMALLINT UNSIGNED DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE PeerServers CHANGE uri_scheme uri_scheme TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways CHANGE uri_scheme uri_scheme TINYINT(1) DEFAULT NULL');
    }
}
