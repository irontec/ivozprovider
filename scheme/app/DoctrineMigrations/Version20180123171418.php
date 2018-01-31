<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class version20180123171418 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('RENAME TABLE `kam_acc_cdrs` TO `kam_trunks_cdrs`');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP proxy');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP asIden');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP asAddress');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP parsed');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP metered');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP pricingPlanName');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP targetPatternName');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP reMeteringDate');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP `externallyRated`');

        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `new_bounced` tinyint(1) DEFAULT NULL AFTER `bounced`');
        $this->addSql('UPDATE `kam_trunks_cdrs` SET new_bounced=1 WHERE bounced=\'yes\'');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP `bounced`');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` CHANGE `new_bounced` `bounced` tinyint(1) DEFAULT NULL');

        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `new_direction` enum(\'inbound\',\'outbound\') DEFAULT NULL AFTER `duration`');
        $this->addSql('UPDATE `kam_trunks_cdrs` SET new_direction=direction');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP `direction`');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` CHANGE `new_direction` `direction` enum(\'inbound\',\'outbound\') DEFAULT NULL ');

        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `cgrid` varchar(40) DEFAULT NULL AFTER `pricingPlanDetails`');
        $this->addSql('CREATE INDEX trunksCdr_cgrid_idx ON kam_trunks_cdrs (cgrid)');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` CHANGE `pricingPlanDetails` `priceDetails` text');

        $this->addSql('ALTER TABLE `kam_trunks_cdrs` MODIFY `peeringContractId` int(10) unsigned DEFAULT NULL');
        $this->addSql('UPDATE `kam_trunks_cdrs` SET `peeringContractId`=NULL WHERE `peeringContractId` NOT IN (SELECT id FROM PeeringContracts)');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD CONSTRAINT FK_92E58EB67DB780F8 FOREIGN KEY (peeringContractId) REFERENCES PeeringContracts (id) ON DELETE SET NULL');

        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX accCdr_invoiceid TO IDX_92E58EB63D7BDC51");
        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX accCdr_brandid TO IDX_92E58EB69CBEC244");
        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX accCdr_companyid TO IDX_92E58EB62480E723");
        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX peeringcontractid_idx TO IDX_92E58EB67DB780F8");
        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX fk_1ac995a6bf3434fc TO IDX_92E58EB6BF3434FC");
        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX fk_1ac995a65c17f7f9 TO IDX_92E58EB65C17F7F9");
        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX start_time_idx TO trunksCdr_start_time_idx");
        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX calldate_idx TO trunksCdr_end_time_idx");
        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX callid_idx TO trunksCdr_callid_idx");
        $this->addSql("ALTER TABLE kam_trunks_cdrs RENAME INDEX xcallid_idx TO trunksCdr_xcallid_idx");

        $this->addSql('CREATE INDEX trunksCdr_direction_idx ON kam_trunks_cdrs (direction)');

        $this->addSql('CREATE TABLE `tp_versions` ( `id` int(11) NOT NULL AUTO_INCREMENT, `item` varchar(64) NOT NULL, `version` int(11) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `id_item` (`id`,`item`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addSql("INSERT INTO `tp_versions` VALUES (1,'TpLCR',1),(2,'TpRatingPlan',1),(3,'CostDetails',2),(4,'TpDestinationRates',1),(5,'TpThresholds',1),(6,'TpActionTriggers',1),(7,'TpAliases',1),(8,'TpDerivedChargers',1),(9,'TpRatingPlans',1),(10,'TpFilters',1),(11,'TpCdrStats',1),(12,'TpSharedGroups',1),(13,'TpDestinations',1),(14,'TpAccountActions',1),(15,'TpSuppliers',1),(16,'TpRatingProfiles',1),(17,'TpRates',1),(18,'TpResources',1),(19,'TpTiming',1),(20,'TpUsers',1),(21,'TpActions',1),(22,'TpDerivedCharges',1),(23,'TpStats',1),(24,'TpRatingProfile',1),(25,'TpLcrs',1),(26,'TpActionPlans',1),(27,'TpResource',1)");

        $this->addSql("CREATE TABLE tp_cdrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, cgrid VARCHAR(40) NOT NULL, run_id VARCHAR(64) NOT NULL, origin_host VARCHAR(64) NOT NULL, source VARCHAR(64) NOT NULL, origin_id VARCHAR(128) NOT NULL, tor VARCHAR(16) NOT NULL, request_type VARCHAR(24) NOT NULL, tenant VARCHAR(64) NOT NULL, category VARCHAR(32) NOT NULL, account VARCHAR(128) NOT NULL, subject VARCHAR(128) NOT NULL, destination VARCHAR(128) NOT NULL, setup_time DATETIME NOT NULL COMMENT '(DC2Type:datetime)', answer_time DATETIME NOT NULL COMMENT '(DC2Type:datetime)', `usage` BIGINT NOT NULL, extra_fields LONGTEXT NOT NULL, cost_source VARCHAR(64) NOT NULL, cost NUMERIC(20, 4) NOT NULL, cost_details LONGTEXT NOT NULL, extra_info LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime)', deleted_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime)', UNIQUE INDEX tpCdrs_cdrrun (cgrid, run_id, origin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `kam_trunks_cdrs` CHANGE `priceDetails` `pricingPlanDetails` text');
        $this->addSql('DROP TABLE `tp_cdrs`');
        $this->addSql('DROP TABLE `tp_versions`');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP KEY trunksCdr_direction_idx');
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX IDX_92E58EB63D7BDC51 TO accCdr_invoiceid");
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX IDX_92E58EB69CBEC244 TO accCdr_brandid");
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX IDX_92E58EB62480E723 TO accCdr_companyid");
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX IDX_92E58EB67DB780F8 TO peeringcontractid_idx");
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX trunksCdr_start_time_idx TO start_time_idx");
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX trunksCdr_end_time_idx TO calldate_idx");
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX trunksCdr_callid_idx TO callid_idx");
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX trunksCdr_xcallid_idx TO xcallid_idx");
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX IDX_92E58EB6BF3434FC TO fk_1ac995a6bf3434fc");
        $this->addSql("ALTER TABLE `kam_trunks_cdrs` RENAME INDEX IDX_92E58EB65C17F7F9 TO fk_1ac995a65c17f7f9");
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP FOREIGN KEY `FK_92E58EB67DB780F8`');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` MODIFY `peeringContractId` varchar(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP `cgrid`');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `externallyRated` tinyint(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` CHANGE `bounced` `new_bounced` tinyint(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `bounced` enum(\'yes\',\'no\') NOT NULL DEFAULT \'no\' AFTER `new_bounced`');
        $this->addSql('UPDATE `kam_trunks_cdrs` SET bounced=\'yes\' WHERE new_bounced=1');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` DROP `new_bounced`');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `reMeteringDate` datetime DEFAULT NULL');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `targetPatternName` varchar(55) DEFAULT NULL');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `pricingPlanName` varchar(55) DEFAULT NULL');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `metered` tinyint(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `parsed` enum(\'yes\',\'no\',\'error\') DEFAULT \'no\'');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `asAddress` varchar(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `asIden` varchar(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE `kam_trunks_cdrs` ADD `proxy` varchar(64) DEFAULT NULL');
        $this->addSql('UPDATE `kam_trunks_cdrs` SET proxy=\'PSTN\'');
        $this->addSql('RENAME TABLE `kam_trunks_cdrs` TO `kam_acc_cdrs`');
    }
}
