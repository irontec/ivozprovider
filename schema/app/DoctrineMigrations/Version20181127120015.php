<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181127120015 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers CHANGE unit unit VARCHAR(30) DEFAULT \'month\' NOT NULL COMMENT \'[enum:day|week|month]\', CHANGE companyId companyId INT UNSIGNED DEFAULT NULL');

        $this->addSql('ALTER TABLE CallCsvReports ADD brandId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CallCsvReports ADD CONSTRAINT FK_3DC217439CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_3DC217439CBEC244 ON CallCsvReports (brandId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers CHANGE unit unit VARCHAR(30) DEFAULT \'month\' NOT NULL COLLATE utf8_unicode_ci COMMENT \'[enum:week|month|year]\', CHANGE companyId companyId INT UNSIGNED NOT NULL');

        $this->addSql('ALTER TABLE CallCsvReports DROP FOREIGN KEY FK_3DC217439CBEC244');
        $this->addSql('DROP INDEX IDX_3DC217439CBEC244 ON CallCsvReports');
        $this->addSql('ALTER TABLE CallCsvReports DROP brandId');
    }
}
