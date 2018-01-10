<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180110143040 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP VIEW BillableCalls');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("CREATE VIEW `BillableCalls` AS (select `kam_acc_cdrs`.`id` AS `id`,`kam_acc_cdrs`.`proxy` AS `proxy`,`kam_acc_cdrs`.`start_time` AS `start_time`,`kam_acc_cdrs`.`end_time` AS `end_time`,`kam_acc_cdrs`.`duration` AS `duration`,`kam_acc_cdrs`.`caller` AS `caller`,`kam_acc_cdrs`.`callee` AS `callee`,`kam_acc_cdrs`.`referee` AS `referee`,`kam_acc_cdrs`.`referrer` AS `referrer`,`kam_acc_cdrs`.`companyId` AS `companyId`,`kam_acc_cdrs`.`brandId` AS `brandId`,`kam_acc_cdrs`.`asIden` AS `asIden`,`kam_acc_cdrs`.`asAddress` AS `asAddress`,`kam_acc_cdrs`.`callid` AS `callid`,`kam_acc_cdrs`.`callidHash` AS `callidHash`,`kam_acc_cdrs`.`xcallid` AS `xcallid`,`kam_acc_cdrs`.`parsed` AS `parsed`,`kam_acc_cdrs`.`diversion` AS `diversion`,`kam_acc_cdrs`.`peeringContractId` AS `peeringContractId`,`kam_acc_cdrs`.`bounced` AS `bounced`,`kam_acc_cdrs`.`externallyRated` AS `externallyRated`,`kam_acc_cdrs`.`metered` AS `metered`,`kam_acc_cdrs`.`meteringDate` AS `meteringDate`,`kam_acc_cdrs`.`pricingPlanId` AS `pricingPlanId`,`kam_acc_cdrs`.`pricingPlanName` AS `pricingPlanName`,`kam_acc_cdrs`.`targetPatternId` AS `targetPatternId`,`kam_acc_cdrs`.`targetPatternName` AS `targetPatternName`,`kam_acc_cdrs`.`price` AS `price`,`kam_acc_cdrs`.`pricingPlanDetails` AS `pricingPlanDetails`,`kam_acc_cdrs`.`invoiceId` AS `invoiceId`,`kam_acc_cdrs`.`direction` AS `direction`,`kam_acc_cdrs`.`reMeteringDate` AS `reMeteringDate` from `kam_acc_cdrs` where ((`kam_acc_cdrs`.`peeringContractId` is not null) and (`kam_acc_cdrs`.`peeringContractId` <> '')))");
    }
}
