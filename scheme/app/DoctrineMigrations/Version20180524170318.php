<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180524170318 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE LcrRules DROP tag, DROP description');
        $this->addSql('ALTER TABLE LcrGateways DROP flags');
        $this->addSql('UPDATE LcrGateways SET tag=NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE LcrGateways ADD flags INT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE LcrRules ADD tag VARCHAR(55) NOT NULL COLLATE utf8_general_ci, ADD description VARCHAR(500) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci');
        $this->addSql('UPDATE LcrGateways SET tag=peerServerId');
        $this->addSql('UPDATE LcrGateways LG LEFT JOIN PeerServers PS ON LG.peerServerId=PS.id SET flags=(PS.sendPAI + 2* PS.sendRPID)');
    }
}
