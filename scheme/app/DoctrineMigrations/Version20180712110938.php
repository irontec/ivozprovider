<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180712110938 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE FixedCostsRelInvoices DROP FOREIGN KEY FixedCostsRelInvoices_ibfk_1');
        $this->addSql('DROP INDEX IDX_1374A9A59CBEC244 ON FixedCostsRelInvoices');
        $this->addSql('ALTER TABLE FixedCostsRelInvoices DROP brandId, CHANGE quantity quantity INT UNSIGNED DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE FixedCostsRelInvoices ADD brandId INT UNSIGNED NOT NULL, CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE FixedCostsRelInvoices ADD CONSTRAINT FixedCostsRelInvoices_ibfk_1 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_1374A9A59CBEC244 ON FixedCostsRelInvoices (brandId)');
    }
}
