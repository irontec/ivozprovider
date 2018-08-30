<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180830105838 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_lcr_rules ADD routingPatternGroupsRelPatternId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_lcr_rules ADD CONSTRAINT FK_52D75CD64B03349B FOREIGN KEY (routingPatternGroupsRelPatternId) REFERENCES RoutingPatternGroupsRelPatterns (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_52D75CD64B03349B ON kam_trunks_lcr_rules (routingPatternGroupsRelPatternId)');
        $this->addSql('UPDATE kam_trunks_lcr_rules KTLR 
                          INNER JOIN OutgoingRouting O
                            ON O.id = KTLR.outgoingRoutingId
                          INNER JOIN RoutingPatternGroupsRelPatterns RPGRP
                            ON RPGRP.routingPatternGroupId = O.routingPatternGroupId
                            AND RPGRP.routingPatternId = KTLR.routingPatternId
                          SET routingPatternGroupsRelPatternId = RPGRP.id'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_lcr_rules DROP FOREIGN KEY FK_52D75CD64B03349B');
        $this->addSql('DROP INDEX IDX_52D75CD64B03349B ON kam_trunks_lcr_rules');
        $this->addSql('ALTER TABLE kam_trunks_lcr_rules DROP routingPatternGroupsRelPatternId');
    }
}
