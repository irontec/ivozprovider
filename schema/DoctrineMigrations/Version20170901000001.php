<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170901000001 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Companies CHANGE onDemandRecord onDemandRecord SMALLINT DEFAULT 0');
        $this->addSql('ALTER TABLE FaxesInOut CHANGE calldate calldate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Users CHANGE externalIpCalls externalIpCalls VARCHAR(1) DEFAULT \'0\' NOT NULL COMMENT \'[enum:0|1|2|3]\'');
        $this->addSql('ALTER TABLE LcrRuleTargets CHANGE priority priority SMALLINT UNSIGNED NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX psEndpoint_id ON ast_ps_endpoints (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE LcrRuleTargets CHANGE priority priority TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX psEndpoint_id ON ast_ps_endpoints');
        $this->addSql('ALTER TABLE Companies CHANGE onDemandRecord onDemandRecord TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE Users CHANGE externalIpCalls externalIpCalls TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'[enum:0|1|2|3]\'');
    }
}
