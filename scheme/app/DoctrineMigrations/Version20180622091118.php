<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180622091118 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE InvoiceSchedulers (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, unit VARCHAR(30) DEFAULT \'month\' NOT NULL COMMENT \'[enum:week|month|year]\', frequency SMALLINT UNSIGNED NOT NULL, email VARCHAR(140) NOT NULL, inProgress TINYINT(1) DEFAULT \'0\' NOT NULL, lastExecution DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', brandId INT UNSIGNED NOT NULL, invoiceNumberSequenceId INT UNSIGNED DEFAULT NULL, INDEX IDX_41E90A1A9CBEC244 (brandId), INDEX IDX_41E90A1A4539C703 (invoiceNumberSequenceId), UNIQUE INDEX invoiceScheduler_name_brand (name, brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE InvoiceNumberSequences (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, prefix VARCHAR(20) DEFAULT \'\' NOT NULL, sequenceLength SMALLINT UNSIGNED NOT NULL, increment SMALLINT UNSIGNED NOT NULL, latestValue VARCHAR(255) DEFAULT \'\', iteration SMALLINT UNSIGNED DEFAULT 0 NOT NULL, version INT DEFAULT 1 NOT NULL, brandId INT UNSIGNED NOT NULL, INDEX IDX_A7624D1E9CBEC244 (brandId), UNIQUE INDEX invoiceNumberSequence_name_brand (name, brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE InvoiceSchedulers ADD CONSTRAINT FK_41E90A1A9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE InvoiceSchedulers ADD CONSTRAINT FK_41E90A1A4539C703 FOREIGN KEY (invoiceNumberSequenceId) REFERENCES InvoiceNumberSequences (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE InvoiceNumberSequences ADD CONSTRAINT FK_A7624D1E9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Invoices ADD invoiceNumberSequenceId INT UNSIGNED DEFAULT NULL, CHANGE number number VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoices ADD CONSTRAINT FK_93594DC34539C703 FOREIGN KEY (invoiceNumberSequenceId) REFERENCES InvoiceNumberSequences (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_93594DC34539C703 ON Invoices (invoiceNumberSequenceId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE InvoiceSchedulers DROP FOREIGN KEY FK_41E90A1A4539C703');
        $this->addSql('ALTER TABLE Invoices DROP FOREIGN KEY FK_93594DC34539C703');
        $this->addSql('DROP TABLE InvoiceSchedulers');
        $this->addSql('DROP TABLE InvoiceNumberSequences');
        $this->addSql('DROP INDEX IDX_93594DC34539C703 ON Invoices');
        $this->addSql('ALTER TABLE Invoices DROP invoiceNumberSequenceId');
    }
}
