<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180809101240 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
        'CREATE TABLE BillableCalls (
              id INT UNSIGNED AUTO_INCREMENT NOT NULL, 
              callid VARCHAR(255) DEFAULT NULL, 
              startTime DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', 
              duration DOUBLE PRECISION DEFAULT \'0.000\' NOT NULL, 
              caller VARCHAR(128) DEFAULT NULL, 
              callee VARCHAR(128) DEFAULT NULL, 
              cost NUMERIC(20, 4) DEFAULT NULL, 
              price NUMERIC(20, 4) DEFAULT NULL, 
              priceDetails LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', 
              carrierName VARCHAR(200) DEFAULT NULL, 
              destinationName VARCHAR(100) DEFAULT NULL, 
              ratingPlanName VARCHAR(55) DEFAULT NULL, 
              brandId INT UNSIGNED NOT NULL, 
              companyId INT UNSIGNED NOT NULL, 
              carrierId INT UNSIGNED DEFAULT NULL, 
              destinationId INT UNSIGNED DEFAULT NULL, 
              ratingPlanId INT UNSIGNED DEFAULT NULL, 
              invoiceId INT UNSIGNED DEFAULT NULL, 
              trunksCdrId INT UNSIGNED DEFAULT NULL, 
              INDEX IDX_E6F2DA359CBEC244 (brandId), 
              INDEX IDX_E6F2DA352480E723 (companyId), 
              INDEX IDX_E6F2DA356709B1C (carrierId), 
              INDEX IDX_E6F2DA35BF3434FC (destinationId), 
              INDEX IDX_E6F2DA355C17F7F9 (ratingPlanId), 
              INDEX IDX_E6F2DA353D7BDC51 (invoiceId), 
              INDEX IDX_E6F2DA353B9439A5 (trunksCdrId), 
              PRIMARY KEY(id)
          ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // Migrating existing data from kam_trunks_cdrs
        $this->addSql('INSERT INTO BillableCalls (
                              callid, startTime, duration,
                              caller, callee, price, priceDetails,
                              brandId, companyId, carrierId, invoiceId, trunksCdrId
                          ) SELECT callid, start_time, duration,
                            COALESCE(NULLIF(diversion,""), caller), callee, price, priceDetails,
                            brandId, companyId, carrierId, invoiceId, id
                          FROM kam_trunks_cdrs
                            WHERE direction = "outbound"');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA359CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA352480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA356709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA35BF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA355C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlans (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA353D7BDC51 FOREIGN KEY (invoiceId) REFERENCES Invoices (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA353B9439A5 FOREIGN KEY (trunksCdrId) REFERENCES kam_trunks_cdrs (id) ON DELETE SET NULL');

        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD metered TINYINT(1) DEFAULT \'0\'');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');

        // Mark all CDR entries as metered
        $step = 500000;
        $rows = $this->connection->query("SELECT 1 FROM kam_trunks_cdrs WHERE direction='outbound'")->rowCount();
        while ($rows > 0) {
            $limit = ($rows > $step) ? $step : $rows;
            $this->addSql("UPDATE kam_trunks_cdrs SET metered = 1 WHERE direction='outbound' AND metered != 1 LIMIT $limit");
            $rows -= $limit;
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE BillableCalls');

        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP metered');
    }
}
