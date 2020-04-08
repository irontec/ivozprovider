<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180817101632 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB63D7BDC51');
        $this->addSql('DROP INDEX IDX_92E58EB63D7BDC51 ON kam_trunks_cdrs');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP referee, DROP referrer, DROP price, DROP priceDetails, DROP invoiceId');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD referee VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, ADD referrer VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, ADD price NUMERIC(10, 4) DEFAULT NULL, ADD priceDetails TEXT DEFAULT NULL COLLATE utf8_general_ci, ADD invoiceId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB63D7BDC51 FOREIGN KEY (invoiceId) REFERENCES Invoices (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_92E58EB63D7BDC51 ON kam_trunks_cdrs (invoiceId)');
    }
}
