<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180528114746 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('RENAME TABLE LcrGateways TO kam_trunks_lcr_gateways');
        $this->addSql('RENAME TABLE LcrRules TO kam_trunks_lcr_rules');
        $this->addSql('RENAME TABLE LcrRuleTargets TO kam_trunks_lcr_rule_targets');

        $this->addSql('ALTER TABLE kam_trunks_lcr_rules RENAME INDEX idx_69ddb35c6d661974 TO IDX_52D75CD66D661974');
        $this->addSql('ALTER TABLE kam_trunks_lcr_rules RENAME INDEX idx_69ddb35c3cde892 TO IDX_52D75CD63CDE892');
        $this->addSql('ALTER TABLE kam_trunks_lcr_rule_targets RENAME INDEX idx_2ec3b847744e0351 TO IDX_E814F399744E0351');
        $this->addSql('ALTER TABLE kam_trunks_lcr_rule_targets RENAME INDEX idx_2ec3b84782d8d847 TO IDX_E814F39982D8D847');
        $this->addSql('ALTER TABLE kam_trunks_lcr_rule_targets RENAME INDEX idx_2ec3b8473cde892 TO IDX_E814F3993CDE892');

        $this->addSql("UPDATE kam_version SET `table_name`='kam_trunks_lcr_gateways' WHERE `table_name`='LcrGateways'");
        $this->addSql("UPDATE kam_version SET `table_name`='kam_trunks_lcr_rules' WHERE `table_name`='LcrRules'");
        $this->addSql("UPDATE kam_version SET `table_name`='kam_trunks_lcr_rule_targets' WHERE `table_name`='LcrRuleTargets'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('RENAME TABLE kam_trunks_lcr_gateways TO LcrGateways');
        $this->addSql('RENAME TABLE kam_trunks_lcr_rules TO LcrRules');
        $this->addSql('RENAME TABLE kam_trunks_lcr_rule_targets TO LcrRuleTargets');

        $this->addSql('ALTER TABLE LcrRuleTargets RENAME INDEX idx_e814f399744e0351 TO IDX_2EC3B847744E0351');
        $this->addSql('ALTER TABLE LcrRuleTargets RENAME INDEX idx_e814f39982d8d847 TO IDX_2EC3B84782D8D847');
        $this->addSql('ALTER TABLE LcrRuleTargets RENAME INDEX idx_e814f3993cde892 TO IDX_2EC3B8473CDE892');
        $this->addSql('ALTER TABLE LcrRules RENAME INDEX idx_52d75cd66d661974 TO IDX_69DDB35C6D661974');
        $this->addSql('ALTER TABLE LcrRules RENAME INDEX idx_52d75cd63cde892 TO IDX_69DDB35C3CDE892');

        $this->addSql("UPDATE kam_version SET `table_name`='LcrRuleTargets' WHERE `table_name`='kam_trunks_lcr_rule_targets'");
        $this->addSql("UPDATE kam_version SET `table_name`='LcrRules' WHERE `table_name`='kam_trunks_lcr_rules'");
        $this->addSql("UPDATE kam_version SET `table_name`='LcrGateways' WHERE `table_name`='kam_trunks_lcr_gateways'");
    }
}
