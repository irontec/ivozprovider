<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20210225102902 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'CREATE TABLE BillableCallHistorics (
                id INT UNSIGNED NOT NULL, 
                callid VARCHAR(255) DEFAULT NULL, 
                startTime DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', 
                duration DOUBLE PRECISION DEFAULT \'0\' NOT NULL, 
                caller VARCHAR(128) DEFAULT NULL, callee VARCHAR(128) DEFAULT NULL, 
                cost NUMERIC(20, 4) DEFAULT NULL COMMENT \'(DC2Type:decimal)\', 
                price NUMERIC(20, 4) DEFAULT NULL COMMENT \'(DC2Type:decimal)\', 
                priceDetails LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', 
                carrierName VARCHAR(200) DEFAULT NULL, 
                destinationName VARCHAR(100) DEFAULT NULL, 
                ratingPlanName VARCHAR(55) DEFAULT NULL, 
                brandId INT UNSIGNED DEFAULT NULL, 
                companyId INT UNSIGNED DEFAULT NULL, 
                carrierId INT UNSIGNED DEFAULT NULL, 
                destinationId INT UNSIGNED DEFAULT NULL, 
                ratingPlanGroupId INT UNSIGNED DEFAULT NULL, 
                invoiceId INT UNSIGNED DEFAULT NULL, 
                trunksCdrId INT UNSIGNED DEFAULT NULL, 
                endpointType VARCHAR(55) DEFAULT NULL COMMENT \'[enum:RetailAccount|ResidentialDevice|User|Friend|Fax]\', 
                endpointId INT UNSIGNED DEFAULT NULL, 
                direction VARCHAR(255) DEFAULT \'outbound\' COMMENT \'[enum:inbound|outbound]\', 
                ddiId INT UNSIGNED DEFAULT NULL, 
                ddiProviderId INT UNSIGNED DEFAULT NULL,
                endpointName VARCHAR(65) DEFAULT NULL, 
                INDEX billableCallHistoric_startTime_idx (startTime), 
                INDEX billableCallHistoric_callid_idx (callid), 
                INDEX billableCallHistoric_caller_idx (caller), 
                INDEX billableCallHistoric_callee_idx (callee), 
                INDEX billableCallHistoric_brand_company_idx (brandId, companyId), 
                INDEX billableCallHistoric_company_idx (companyId) 
            )
            DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
            PARTITION BY HASH(YEAR(startTime))
            PARTITIONS 6'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE BillableCallHistorics');
    }
}
