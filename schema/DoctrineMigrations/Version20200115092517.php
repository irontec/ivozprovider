<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200115092517 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE SpecialNumbers (id INT UNSIGNED AUTO_INCREMENT NOT NULL, number VARCHAR(25) NOT NULL, numberE164 VARCHAR(25) DEFAULT NULL, disableCDR INT UNSIGNED DEFAULT 1 NOT NULL, brandId INT UNSIGNED DEFAULT NULL, countryId INT UNSIGNED NOT NULL, INDEX IDX_8D0323969CBEC244 (brandId), INDEX IDX_8D032396FBA2A6B4 (countryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE SpecialNumbers ADD CONSTRAINT FK_8D0323969CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE SpecialNumbers ADD CONSTRAINT FK_8D032396FBA2A6B4 FOREIGN KEY (countryId) REFERENCES Countries (id) ON DELETE CASCADE');

        // Add field to hide certain users calls
        $this->addSql("ALTER TABLE kam_users_cdrs ADD hidden TINYINT(1) NOT NULL DEFAULT '0'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE SpecialNumbers');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP hidden');
    }
}
