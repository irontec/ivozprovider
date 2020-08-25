<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200825140817 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP VIEW tp_actions');
        $this->addSql('CREATE VIEW `tp_actions` AS SELECT CONCAT("b", id) AS tpid, "DISABLE_AND_LOG" AS tag, "*call_url" AS action, "*default" AS balance_tag, "*monetary" AS balance_type, "http://trunks.ivozprovider.local:8001/endCompanyCalls" AS extra_parameters FROM Brands UNION SELECT CONCAT("b", id) AS tpid, "DISABLE_AND_LOG" AS tag, "*disable_account" AS action, "*default" AS balance_tag, "*monetary" AS balance_type, NULL AS extra_parameters FROM Brands UNION SELECT CONCAT("b", id) AS tpid, "DISABLE_AND_LOG" AS tag, "*log" AS action, "*default" AS balance_tag, "*monetary" AS balance_type, NULL AS extra_parameters FROM Brands');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP VIEW tp_actions');
        $this->addSql('CREATE VIEW `tp_actions` AS SELECT CONCAT("b", id) AS tpid, "DISABLE_AND_LOG" AS tag, "*disable_account" AS action, "*default" AS balance_tag, "*monetary" AS balance_type FROM Brands UNION SELECT CONCAT("b", id) AS tpid, "DISABLE_AND_LOG" AS tag, "*log" AS action, "*default" AS balance_tag, "*monetary" AS balance_type FROM Brands');
    }
}
