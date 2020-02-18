<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200109172609 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP VIEW `tp_action_triggers`');
        $this->addSql('CREATE VIEW `tp_action_triggers` AS SELECT CONCAT("b", brandId) AS tpid, CONCAT("c", id) AS tag, "*default" AS unique_id, "*max_balance_counter" AS threshold_type, maxDailyUsage AS threshold_value, 1 AS recurrent, "*default" AS balance_tag, "*monetary" AS balance_type, "DISABLE_AND_LOG" AS actions_tag, 0.0 AS weight FROM Companies');

        $this->addSql('UPDATE tp_account_actions SET action_triggers_tag=account WHERE companyId IS NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP VIEW `tp_action_triggers`');
        $this->addSql('CREATE VIEW `tp_action_triggers` AS SELECT CONCAT("b", id) AS tpid, "STANDARD_TRIGGERS" AS tag, "*default" AS unique_id, "*max_balance_counter" AS threshold_type, 1000000 AS threshold_value, 1 AS recurrent, "*default" AS balance_tag, "*monetary" AS balance_type, "DISABLE_AND_LOG" AS actions_tag, 0.0 AS weight FROM Brands');

        $this->addSql('UPDATE tp_account_actions SET action_triggers_tag="STANDARD_TRIGGERS" WHERE companyId IS NOT NULL');
    }
}
