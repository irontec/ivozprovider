<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180606134347 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Companies RENAME INDEX ccompany_name_brand TO company_name_brand');
        $this->addSql('ALTER TABLE PeerServers CHANGE transport transport SMALLINT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways CHANGE transport transport SMALLINT UNSIGNED DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Companies RENAME INDEX company_name_brand TO cCompany_name_brand');
        $this->addSql('ALTER TABLE PeerServers CHANGE transport transport TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways CHANGE transport transport TINYINT(1) DEFAULT NULL');
    }
}
