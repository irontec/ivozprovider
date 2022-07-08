<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20220707084112 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers ADD ddisCountryMatch VARCHAR(25) DEFAULT \'all\' COMMENT \'[enum:all|national|international|specific]\', ADD ddisCountryId INT UNSIGNED DEFAULT NULL, CHANGE type type VARCHAR(25) DEFAULT \'static\' NOT NULL COMMENT \'[enum:static|maxcalls|ddis]\'');
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers ADD CONSTRAINT FK_D9D0952B43D707A2 FOREIGN KEY (ddisCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_D9D0952B43D707A2 ON FixedCostsRelInvoiceSchedulers (ddisCountryId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers DROP FOREIGN KEY FK_D9D0952B43D707A2');
        $this->addSql('DROP INDEX IDX_D9D0952B43D707A2 ON FixedCostsRelInvoiceSchedulers');
        $this->addSql('ALTER TABLE FixedCostsRelInvoiceSchedulers DROP ddisCountryMatch, DROP ddisCountryId, CHANGE type type VARCHAR(25) DEFAULT \'static\' NOT NULL COLLATE utf8_unicode_ci COMMENT \'[enum:static|maxcalls]\'');
    }
}
