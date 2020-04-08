<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180116104420 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kam_trunks_cdrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, start_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', end_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', duration DOUBLE PRECISION DEFAULT \'0.000\' NOT NULL, caller VARCHAR(128) DEFAULT NULL, callee VARCHAR(128) DEFAULT NULL, referee VARCHAR(128) DEFAULT NULL, referrer VARCHAR(128) DEFAULT NULL, callid VARCHAR(255) DEFAULT NULL, callidHash VARCHAR(128) DEFAULT NULL, xcallid VARCHAR(255) DEFAULT NULL, diversion VARCHAR(64) DEFAULT NULL, bounced TINYINT(1) DEFAULT NULL, price NUMERIC(10, 4) DEFAULT NULL, priceDetails TEXT DEFAULT NULL, direction VARCHAR(255) DEFAULT NULL, cgrid VARCHAR(40) DEFAULT NULL, invoiceId INT UNSIGNED DEFAULT NULL, brandId INT UNSIGNED DEFAULT NULL, companyId INT UNSIGNED DEFAULT NULL, peeringContractId INT UNSIGNED DEFAULT NULL, destinationId INT UNSIGNED DEFAULT NULL, destinationRateId INT UNSIGNED DEFAULT NULL, INDEX IDX_92E58EB63D7BDC51 (invoiceId), INDEX IDX_92E58EB69CBEC244 (brandId), INDEX IDX_92E58EB62480E723 (companyId), INDEX IDX_92E58EB67DB780F8 (peeringContractId), INDEX IDX_92E58EB6BF3434FC (destinationId), INDEX IDX_92E58EB64EB67480 (destinationRateId), INDEX trunksCdr_start_time_idx (start_time), INDEX trunksCdr_end_time_idx (end_time), INDEX trunksCdr_callid_idx (callid), INDEX trunksCdr_xcallid_idx (xcallid), INDEX trunksCdr_direction_idx (direction), INDEX trunksCdr_cgrid_idx (cgrid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kam_users_cdrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, start_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', end_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', duration DOUBLE PRECISION DEFAULT \'0.000\' NOT NULL, direction VARCHAR(255) DEFAULT NULL, caller VARCHAR(128) DEFAULT NULL, callee VARCHAR(128) DEFAULT NULL, diversion VARCHAR(64) DEFAULT NULL, referee VARCHAR(128) DEFAULT NULL, referrer VARCHAR(128) DEFAULT NULL, callid VARCHAR(255) DEFAULT NULL, callidHash VARCHAR(128) DEFAULT NULL, xcallid VARCHAR(255) DEFAULT NULL, brandId INT UNSIGNED DEFAULT NULL, companyId INT UNSIGNED DEFAULT NULL, userId INT UNSIGNED DEFAULT NULL, friendId INT UNSIGNED DEFAULT NULL, retailAccountId INT UNSIGNED DEFAULT NULL, INDEX start_time_idx (start_time), INDEX end_time_idx (end_time), INDEX callid_idx (callid), INDEX xcallid_idx (xcallid), INDEX usersCdr_brandId (brandId), INDEX usersCdr_companyId (companyId), INDEX usersCdr_userId (userId), INDEX usersCdr_friendId (friendId), INDEX usersCdr_retailAccountId (retailAccountId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tp_cdrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, cgrid VARCHAR(40) NOT NULL, run_id VARCHAR(64) NOT NULL, origin_host VARCHAR(64) NOT NULL, source VARCHAR(64) NOT NULL, origin_id VARCHAR(128) NOT NULL, tor VARCHAR(16) NOT NULL, request_type VARCHAR(24) NOT NULL, tenant VARCHAR(64) NOT NULL, category VARCHAR(32) NOT NULL, account VARCHAR(128) NOT NULL, subject VARCHAR(128) NOT NULL, destination VARCHAR(128) NOT NULL, setup_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime)\', answer_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime)\', `usage` BIGINT NOT NULL, extra_fields LONGTEXT NOT NULL, cost_source VARCHAR(64) NOT NULL, cost NUMERIC(20, 4) NOT NULL, cost_details LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', extra_info LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', UNIQUE INDEX tpCdrs_cdrrun (cgrid, run_id, origin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB63D7BDC51 FOREIGN KEY (invoiceId) REFERENCES Invoices (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB69CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB62480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB67DB780F8 FOREIGN KEY (peeringContractId) REFERENCES PeeringContracts (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB6BF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB64EB67480 FOREIGN KEY (destinationRateId) REFERENCES DestinationRates (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B64B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B893BA339 FOREIGN KEY (friendId) REFERENCES Friends (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B5EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE SET NULL');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');

        // Create tp_versions table (Not handled with ORM entities)
        $this->addSql('CREATE TABLE `tp_versions` ( `id` int(11) NOT NULL AUTO_INCREMENT, `item` varchar(64) NOT NULL, `version` int(11) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `id_item` (`id`,`item`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addSql("INSERT INTO `tp_versions` VALUES (1,'TpLCR',1),(2,'TpRatingPlan',1),(3,'CostDetails',2),(4,'TpDestinationRates',1),(5,'TpThresholds',1),(6,'TpActionTriggers',1),(7,'TpAliases',1),(8,'TpDerivedChargers',1),(9,'TpRatingPlans',1),(10,'TpFilters',1),(11,'TpCdrStats',1),(12,'TpSharedGroups',1),(13,'TpDestinations',1),(14,'TpAccountActions',1),(15,'TpSuppliers',1),(16,'TpRatingProfiles',1),(17,'TpRates',1),(18,'TpResources',1),(19,'TpTiming',1),(20,'TpUsers',1),(21,'TpActions',1),(22,'TpDerivedCharges',1),(23,'TpStats',1),(24,'TpRatingProfile',1),(25,'TpLcrs',1),(26,'TpActionPlans',1),(27,'TpResource',1)");

        // Migrate kam_acc_cdrs User's data
        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('INSERT INTO `kam_users_cdrs` (start_time, end_time, duration, brandId, companyId, direction, caller, callee, diversion, referee, referrer, callid, callidHash, xcallid, userId) SELECT start_time, end_time, TRUNCATE(duration, 3), brandId, kac.companyId, \'outbound\', caller, callee, diversion, referee, referrer, callid, callidHash, xcallid, U.id FROM kam_acc_cdrs kac LEFT JOIN Extensions E ON E.number=kac.callee AND E.companyId = kac.companyId LEFT JOIN Users U ON U.extensionId=E.id WHERE proxy=\'USER\' AND direction=\'inbound\'');
        $this->addSql('INSERT INTO `kam_users_cdrs` (start_time, end_time, duration, brandId, companyId, direction, caller, callee, diversion, referee, referrer, callid, callidHash, xcallid, userId) SELECT start_time, end_time, TRUNCATE(duration, 3), brandId, kac.companyId, \'inbound\', caller, callee, diversion, referee, referrer, callid, callidHash, xcallid, U.id FROM kam_acc_cdrs kac LEFT JOIN Extensions E ON E.number=kac.caller AND E.companyId = kac.companyId LEFT JOIN Users U ON U.extensionId=E.id WHERE proxy=\'USER\' AND direction=\'outbound\'');

        // Migrate kam_acc_cdrs Trunk's data
        $this->addSql('INSERT INTO kam_trunks_cdrs (id, start_time, end_time, duration, caller, callee, referee, referrer, callid, callidHash, xcallid, diversion, bounced, price, priceDetails, direction, invoiceId, brandId, companyId, peeringContractId, destinationId, destinationRateId) SELECT id, start_time_utc, end_time_utc, duration, caller, callee, referee, referrer, callid, callidHash, xcallid, diversion, IF(bounced="yes",1,0), price, pricingPlanDetails, direction, invoiceId, brandId, companyId, IF(peeringContractId="", NULL, peeringContractId), targetPatternId, pricingPlanId FROM kam_acc_cdrs WHERE proxy = \'PSTN\'');

        // Remove all table
        $this->addSql('DROP TABLE kam_acc_cdrs');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kam_acc_cdrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, proxy VARCHAR(64) DEFAULT NULL, start_time_utc DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', end_time_utc DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', start_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', end_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', duration DOUBLE PRECISION DEFAULT \'0.000\' NOT NULL, caller VARCHAR(128) DEFAULT NULL, callee VARCHAR(128) DEFAULT NULL, referee VARCHAR(128) DEFAULT NULL, referrer VARCHAR(128) DEFAULT NULL, companyId INT UNSIGNED DEFAULT NULL, brandId INT UNSIGNED DEFAULT NULL, asIden VARCHAR(64) DEFAULT NULL, asAddress VARCHAR(64) DEFAULT NULL, callid VARCHAR(255) DEFAULT NULL, callidHash VARCHAR(128) DEFAULT NULL, xcallid VARCHAR(255) DEFAULT NULL, parsed VARCHAR(255) DEFAULT \'no\', diversion VARCHAR(64) DEFAULT NULL, peeringContractId VARCHAR(64) DEFAULT NULL, bounced VARCHAR(255) DEFAULT \'no\' NOT NULL, externallyRated TINYINT(1) DEFAULT NULL, metered TINYINT(1) DEFAULT \'0\', meteringDate DATETIME DEFAULT \'0000-00-00 00:00:00\' COMMENT \'(DC2Type:datetime)\', pricingPlanId INT UNSIGNED DEFAULT NULL, pricingPlanName VARCHAR(55) DEFAULT NULL, targetPatternId INT UNSIGNED DEFAULT NULL, targetPatternName VARCHAR(55) DEFAULT NULL, price NUMERIC(10, 4) DEFAULT NULL, pricingPlanDetails TEXT DEFAULT NULL, invoiceId INT UNSIGNED DEFAULT NULL, direction VARCHAR(255) DEFAULT NULL, reMeteringDate DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', INDEX start_time_idx (start_time), INDEX calldate_idx (end_time_utc), INDEX callid_idx (callid), INDEX xcallid_idx (xcallid), INDEX peeringContractId_idx (peeringContractId), INDEX pricingPlanId (pricingPlanId), INDEX targetPatternId (targetPatternId), INDEX invoiceId (invoiceId), INDEX brandId (brandId), INDEX companyId (companyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD CONSTRAINT kam_acc_cdrs_ibfk_1 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD CONSTRAINT kam_acc_cdrs_ibfk_2 FOREIGN KEY (targetPatternId) REFERENCES TargetPatterns (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD CONSTRAINT kam_acc_cdrs_ibfk_3 FOREIGN KEY (invoiceId) REFERENCES Invoices (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD CONSTRAINT kam_acc_cdrs_ibfk_4 FOREIGN KEY (companyId) REFERENCES Companies (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD CONSTRAINT kam_acc_cdrs_ibfk_5 FOREIGN KEY (brandId) REFERENCES Brands (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE kam_trunks_cdrs');
        $this->addSql('DROP TABLE kam_users_cdrs');
        $this->addSql('DROP TABLE tp_cdrs');
    }
}
