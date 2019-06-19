<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180706071646 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'CREATE TABLE FixedCostsRelInvoiceSchedulers (
                    id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                    quantity INT UNSIGNED DEFAULT NULL,
                    fixedCostId INT UNSIGNED NOT NULL,
                    invoiceId INT UNSIGNED NOT NULL,
                    INDEX IDX_D9D0952B81256364 (fixedCostId),
                    INDEX IDX_D9D0952B3D7BDC51 (invoiceId),
                    PRIMARY KEY(id)
                ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers ADD CONSTRAINT FK_D9D0952B81256364 FOREIGN KEY (fixedCostId) REFERENCES FixedCosts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers ADD CONSTRAINT FK_D9D0952B3D7BDC51 FOREIGN KEY (invoiceId) REFERENCES InvoiceSchedulers (id) ON DELETE CASCADE');

        $this->addSql(
            'ALTER TABLE InvoiceSchedulers
                    ADD nextExecution DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\',
                    ADD taxRate NUMERIC(10, 3) DEFAULT NULL,
                    ADD invoiceTemplateId INT UNSIGNED DEFAULT NULL,
                    ADD companyId INT UNSIGNED NOT NULL,
                    DROP inProgress'
        );

        $this->addSql('ALTER TABLE InvoiceSchedulers ADD CONSTRAINT FK_41E90A1AD07541BE FOREIGN KEY (invoiceTemplateId) REFERENCES InvoiceTemplates (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE InvoiceSchedulers ADD CONSTRAINT FK_41E90A1A2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_41E90A1AD07541BE ON InvoiceSchedulers (invoiceTemplateId)');
        $this->addSql('CREATE UNIQUE INDEX invoiceScheduler_company ON InvoiceSchedulers (companyId)');

        $this->addSql(
            'ALTER TABLE Invoices
                    ADD statusMsg VARCHAR(140) DEFAULT NULL,
                    ADD invoiceSchedulerId INT UNSIGNED DEFAULT NULL'
        );
        $this->addSql('ALTER TABLE Invoices ADD CONSTRAINT FK_93594DC31D113CF5 FOREIGN KEY (invoiceSchedulerId) REFERENCES InvoiceSchedulers (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_93594DC31D113CF5 ON Invoices (invoiceSchedulerId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE FixedCostsRelInvoiceSchedulers');
        $this->addSql('ALTER TABLE InvoiceSchedulers DROP FOREIGN KEY FK_41E90A1AD07541BE');
        $this->addSql('ALTER TABLE InvoiceSchedulers DROP FOREIGN KEY FK_41E90A1A2480E723');
        $this->addSql('DROP INDEX IDX_41E90A1AD07541BE ON InvoiceSchedulers');
        $this->addSql('DROP INDEX invoiceScheduler_company ON InvoiceSchedulers');
        $this->addSql('ALTER TABLE InvoiceSchedulers ADD inProgress TINYINT(1) DEFAULT \'0\' NOT NULL, DROP nextExecution, DROP taxRate, DROP invoiceTemplateId, DROP companyId');
        $this->addSql('ALTER TABLE Invoices DROP FOREIGN KEY FK_93594DC31D113CF5');
        $this->addSql('DROP INDEX IDX_93594DC31D113CF5 ON Invoices');
        $this->addSql('ALTER TABLE Invoices DROP statusMsg, DROP invoiceSchedulerId');
    }
}
