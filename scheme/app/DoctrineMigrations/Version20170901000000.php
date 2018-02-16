<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170901000000 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('DROP TABLE XMLRPCLogs');
        $this->addSql('DROP TABLE ParsedCDRs');
        $this->addSql('DROP VIEW BillableCalls');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('CREATE TABLE XMLRPCLogs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, proxy VARCHAR(10) NOT NULL COLLATE utf8_general_ci, module VARCHAR(10) NOT NULL COLLATE utf8_general_ci, method VARCHAR(10) NOT NULL COLLATE utf8_general_ci, mapperName VARCHAR(20) NOT NULL COLLATE utf8_general_ci, startDate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, execDate DATETIME DEFAULT NULL, finishDate DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql("CREATE VIEW `BillableCalls` AS (select `kam_acc_cdrs`.`id` AS `id`,`kam_acc_cdrs`.`proxy` AS `proxy`,`kam_acc_cdrs`.`start_time` AS `start_time`,`kam_acc_cdrs`.`end_time` AS `end_time`,`kam_acc_cdrs`.`duration` AS `duration`,`kam_acc_cdrs`.`caller` AS `caller`,`kam_acc_cdrs`.`callee` AS `callee`,`kam_acc_cdrs`.`referee` AS `referee`,`kam_acc_cdrs`.`referrer` AS `referrer`,`kam_acc_cdrs`.`companyId` AS `companyId`,`kam_acc_cdrs`.`brandId` AS `brandId`,`kam_acc_cdrs`.`asIden` AS `asIden`,`kam_acc_cdrs`.`asAddress` AS `asAddress`,`kam_acc_cdrs`.`callid` AS `callid`,`kam_acc_cdrs`.`callidHash` AS `callidHash`,`kam_acc_cdrs`.`xcallid` AS `xcallid`,`kam_acc_cdrs`.`parsed` AS `parsed`,`kam_acc_cdrs`.`diversion` AS `diversion`,`kam_acc_cdrs`.`peeringContractId` AS `peeringContractId`,`kam_acc_cdrs`.`bounced` AS `bounced`,`kam_acc_cdrs`.`externallyRated` AS `externallyRated`,`kam_acc_cdrs`.`metered` AS `metered`,`kam_acc_cdrs`.`meteringDate` AS `meteringDate`,`kam_acc_cdrs`.`pricingPlanId` AS `pricingPlanId`,`kam_acc_cdrs`.`pricingPlanName` AS `pricingPlanName`,`kam_acc_cdrs`.`targetPatternId` AS `targetPatternId`,`kam_acc_cdrs`.`targetPatternName` AS `targetPatternName`,`kam_acc_cdrs`.`price` AS `price`,`kam_acc_cdrs`.`pricingPlanDetails` AS `pricingPlanDetails`,`kam_acc_cdrs`.`invoiceId` AS `invoiceId`,`kam_acc_cdrs`.`direction` AS `direction`,`kam_acc_cdrs`.`reMeteringDate` AS `reMeteringDate` from `kam_acc_cdrs` where ((`kam_acc_cdrs`.`peeringContractId` is not null) and (`kam_acc_cdrs`.`peeringContractId` <> '')))");
        $this->addSql('CREATE TABLE ParsedCDRs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, statId INT UNSIGNED DEFAULT NULL, xstatId INT UNSIGNED DEFAULT NULL, statType VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, initialLeg VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, initialLegHash VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, cid VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, cidHash VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, xcid VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, xcidHash VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, proxies VARCHAR(32) DEFAULT NULL COLLATE utf8_general_ci, type VARCHAR(32) DEFAULT NULL COLLATE utf8_general_ci, subtype VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, calldate DATETIME DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL COMMENT \'(DC2Type:datetime)\', duration INT UNSIGNED DEFAULT NULL, aParty VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, bParty VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, caller VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, callee VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, xCaller VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, xCallee VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, initialReferrer VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, referrer VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, referee VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, lastForwarder VARCHAR(32) DEFAULT NULL COLLATE utf8_general_ci, brandId INT UNSIGNED DEFAULT NULL, companyId INT UNSIGNED DEFAULT NULL, peeringContractId INT UNSIGNED DEFAULT NULL, UNIQUE INDEX cid (cid), INDEX brandId (brandId), INDEX companyId (companyId), INDEX peeringContractId (peeringContractId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ParsedCDRs ADD CONSTRAINT FK_A94BA5792480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ParsedCDRs ADD CONSTRAINT FK_A94BA5797DB780F8 FOREIGN KEY (peeringContractId) REFERENCES PeeringContracts (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ParsedCDRs ADD CONSTRAINT FK_A94BA5799CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
    }
}
