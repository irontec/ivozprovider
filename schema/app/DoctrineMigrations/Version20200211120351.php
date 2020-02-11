<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200211120351 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers DROP FOREIGN KEY FK_D9D0952B3D7BDC51');
        $this->addSql('DROP INDEX IDX_D9D0952B3D7BDC51 ON FixedCostsRelInvoiceSchedulers');
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers CHANGE invoiceid invoiceSchedulerId INT UNSIGNED NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX FixedCostsRelInvoiceScheduler_invoiceScheduler_fixedCost ON FixedCostsRelInvoiceSchedulers (invoiceSchedulerId, fixedCostId)');
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers ADD CONSTRAINT FK_D9D0952B1D113CF5 FOREIGN KEY (invoiceSchedulerId) REFERENCES InvoiceSchedulers (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers DROP FOREIGN KEY FK_D9D0952B1D113CF5');
        $this->addSql('DROP INDEX IDX_D9D0952B1D113CF5 ON FixedCostsRelInvoiceSchedulers');
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers CHANGE invoiceschedulerid invoiceId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers ADD CONSTRAINT FK_D9D0952B3D7BDC51 FOREIGN KEY (invoiceId) REFERENCES InvoiceSchedulers (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_D9D0952B3D7BDC51 ON FixedCostsRelInvoiceSchedulers (invoiceId)');
        $this->addSql('DROP INDEX FixedCostsRelInvoiceScheduler_invoiceScheduler_fixedCost ON FixedCostsRelInvoiceSchedulers');
    }
}
