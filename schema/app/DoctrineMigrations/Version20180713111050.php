<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180713111050 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallForwardSettings CHANGE userId userId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY FK_528CEED99FB29831');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT FK_528CEED99FB29831 FOREIGN KEY (holidayLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY FK_528CEED99FB29831');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT FK_528CEED99FB29831 FOREIGN KEY (holidayLocutionId) REFERENCES Locutions (id)');
        $this->addSql('ALTER TABLE CallForwardSettings CHANGE userId userId INT UNSIGNED NOT NULL');
    }
}
