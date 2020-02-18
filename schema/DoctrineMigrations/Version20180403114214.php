<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180403114214 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY Brands_ibfk_3');
        $this->addSql('ALTER TABLE Brands CHANGE defaultTimezoneId defaultTimezoneId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E4102A27130E4 FOREIGN KEY (defaultTimezoneId) REFERENCES Timezones (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E4102A27130E4');
        $this->addSql('ALTER TABLE Brands CHANGE defaultTimezoneId defaultTimezoneId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT Brands_ibfk_3 FOREIGN KEY (defaultTimezoneId) REFERENCES Timezones (id) ON DELETE SET NULL');
    }
}
