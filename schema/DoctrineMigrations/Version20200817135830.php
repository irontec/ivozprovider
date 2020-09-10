<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200817135830 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE CompaniesRelGeoIPCountries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, companyId INT UNSIGNED NOT NULL, countryId INT UNSIGNED NOT NULL, INDEX IDX_4A16E7792480E723 (companyId), INDEX IDX_4A16E779FBA2A6B4 (countryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE CompaniesRelGeoIPCountries ADD CONSTRAINT FK_4A16E7792480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CompaniesRelGeoIPCountries ADD CONSTRAINT FK_4A16E779FBA2A6B4 FOREIGN KEY (countryId) REFERENCES Countries (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE CompaniesRelGeoIPCountries');
    }
}
