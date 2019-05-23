<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190520145100 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ast_ps_endpoints CHANGE t38_udptl_ec t38_udptl_ec VARCHAR(255) DEFAULT \'redundancy\' NOT NULL COMMENT \'[enum:none|fec|redundancy]\', CHANGE t38_udptl_maxdatagram t38_udptl_maxdatagram INT UNSIGNED DEFAULT 1440 NOT NULL, CHANGE t38_udptl_nat t38_udptl_nat VARCHAR(255) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no]\'');

        // Update existing endpoints
        $this->addSql("UPDATE ast_ps_endpoints SET t38_udptl_nat='no', t38_udptl_ec='redundancy', t38_udptl_maxdatagram=1440");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ast_ps_endpoints CHANGE t38_udptl_ec t38_udptl_ec VARCHAR(255) DEFAULT \'none\' NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:none|fec|redundancy]\', CHANGE t38_udptl_maxdatagram t38_udptl_maxdatagram INT UNSIGNED DEFAULT 0 NOT NULL, CHANGE t38_udptl_nat t38_udptl_nat VARCHAR(255) DEFAULT \'yes\' NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:yes|no]\'');

        // Update existing endpoints
        $this->addSql("UPDATE ast_ps_endpoints SET t38_udptl_nat='yes', t38_udptl_ec='none', t38_udptl_maxdatagram=0");
    }
}
