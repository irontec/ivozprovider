<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20220701130804 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers ADD countryId INT UNSIGNED DEFAULT NULL, CHANGE type type VARCHAR(25) DEFAULT \'static\' NOT NULL COMMENT \'[enum:static|maxcalls|ddis]\'');
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers ADD CONSTRAINT FK_D9D0952BFBA2A6B4 FOREIGN KEY (countryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_D9D0952BFBA2A6B4 ON FixedCostsRelInvoiceSchedulers (countryId)');
        $this->addSql('CREATE UNIQUE INDEX FixedCostsRelInvoiceScheduler_iSched_fCost_type_country ON FixedCostsRelInvoiceSchedulers (invoiceSchedulerId, fixedCostId, type, countryId)');
        $this->addSql('DROP INDEX FixedCostsRelInvoiceScheduler_invoiceScheduler_fixedCost ON FixedCostsRelInvoiceSchedulers');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers DROP FOREIGN KEY FK_D9D0952BFBA2A6B4');
        $this->addSql('DROP INDEX IDX_D9D0952BFBA2A6B4 ON FixedCostsRelInvoiceSchedulers');
        $this->addSql('CREATE UNIQUE INDEX FixedCostsRelInvoiceScheduler_invoiceScheduler_fixedCost ON FixedCostsRelInvoiceSchedulers (invoiceSchedulerId, fixedCostId)');
        $this->addSql('DROP INDEX FixedCostsRelInvoiceScheduler_iSched_fCost_type_country ON FixedCostsRelInvoiceSchedulers');
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers DROP countryId, CHANGE type type VARCHAR(25) DEFAULT \'static\' NOT NULL COLLATE utf8_unicode_ci COMMENT \'[enum:static|maxcalls]\'');
    }
}
