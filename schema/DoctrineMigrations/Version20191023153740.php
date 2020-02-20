<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191023153740 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // New CGRateS tables for max daily usage
        $this->addSql('CREATE VIEW `tp_action_triggers` AS SELECT CONCAT("b", id) AS tpid, "STANDARD_TRIGGERS" AS tag, "*default" AS unique_id, "*max_balance_counter" AS threshold_type, 1000000 AS threshold_value, 1 AS recurrent, "*default" AS balance_tag, "*monetary" AS balance_type, "DISABLE_AND_LOG" AS actions_tag, 0.0 AS weight FROM Brands');
        $this->addSql('CREATE VIEW `tp_actions` AS SELECT CONCAT("b", id) AS tpid, "DISABLE_AND_LOG" AS tag, "*disable_account" AS action, "*default" AS balance_tag, "*monetary" AS balance_type FROM Brands UNION SELECT CONCAT("b", id) AS tpid, "DISABLE_AND_LOG" AS tag, "*log" AS action, "*default" AS balance_tag, "*monetary" AS balance_type FROM Brands');

        // Allow negative except for non-prepaid clients
        $this->addSql('UPDATE tp_account_actions SET allow_negative=1 WHERE carrierId IS NOT NULL');
        $this->addSql('UPDATE tp_account_actions t JOIN Companies C ON C.id=t.companyId SET allow_negative=0 WHERE C.billingMethod!=\'postpaid\'');
        $this->addSql('UPDATE tp_account_actions t JOIN Companies C ON C.id=t.companyId SET allow_negative=1 WHERE C.billingMethod=\'postpaid\'');

        // Default max daily usage
        $this->addSql('ALTER TABLE Companies ADD maxDailyUsage INT UNSIGNED DEFAULT 1000000 NOT NULL');

        // Enable daily usage counters
        $this->addSql('UPDATE tp_account_actions SET action_triggers_tag="STANDARD_TRIGGERS" WHERE companyId IS NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE tp_account_actions SET action_triggers_tag=NULL');

        $this->addSql('ALTER TABLE Companies DROP maxDailyUsage');

        $this->addSql('UPDATE tp_account_actions SET allow_negative=0');

        $this->addSql('DROP VIEW tp_action_triggers');
        $this->addSql('DROP VIEW tp_actions');
    }
}
