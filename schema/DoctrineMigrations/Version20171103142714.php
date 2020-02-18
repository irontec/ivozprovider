<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171103142714 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Administrators (id INT UNSIGNED AUTO_INCREMENT NOT NULL, username VARCHAR(65) NOT NULL, pass VARCHAR(80) NOT NULL COMMENT \'[password]\', email VARCHAR(100) DEFAULT \'\' NOT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, name VARCHAR(100) DEFAULT NULL, lastname VARCHAR(100) DEFAULT NULL, brandId INT UNSIGNED DEFAULT NULL, companyId INT UNSIGNED DEFAULT NULL, timezoneId INT UNSIGNED DEFAULT NULL, INDEX IDX_CA5E09B79CBEC244 (brandId), INDEX IDX_CA5E09B731D2BA8E (timezoneId), INDEX companyId (companyId), UNIQUE INDEX username (username, brandId, companyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Administrators ADD CONSTRAINT FK_CA5E09B79CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Administrators ADD CONSTRAINT FK_CA5E09B72480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Administrators ADD CONSTRAINT FK_CA5E09B731D2BA8E FOREIGN KEY (timezoneId) REFERENCES Timezones (id) ON DELETE SET NULL');
        $this->addSql('DROP INDEX username ON Administrators');
        $this->addSql('CREATE UNIQUE INDEX username ON Administrators (username, brandId)');

        $this->addSql('INSERT INTO Administrators (username, pass, email, active, name, lastname, timezoneId) SELECT username, pass, email, active, name, lastname, timezoneId FROM MainOperators');
        $this->addSql('INSERT INTO Administrators (username, pass, email, active, name, lastname, timezoneId, brandId) SELECT username, pass, email, active, name, lastname, timezoneId, brandId FROM BrandOperators');
        $this->addSql('INSERT INTO Administrators (username, pass, email, active, name, lastname, timezoneId, companyId) SELECT username, pass, email, active, name, lastname, timezoneId, companyId FROM CompanyAdmins');

        $this->addSql('DROP TABLE BrandOperators');
        $this->addSql('DROP TABLE CompanyAdmins');
        $this->addSql('DROP TABLE MainOperators');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE BrandOperators (id INT UNSIGNED AUTO_INCREMENT NOT NULL, brandId INT UNSIGNED NOT NULL, username VARCHAR(65) NOT NULL COLLATE utf8_general_ci, pass VARCHAR(80) NOT NULL COLLATE utf8_general_ci COMMENT \'[password]\', email VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, active TINYINT(1) DEFAULT \'1\' NOT NULL, timezoneId INT UNSIGNED DEFAULT NULL, name VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci, lastname VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci, UNIQUE INDEX MainOperatorsUniqueBrandUsername (brandId, username), INDEX brandId (brandId), INDEX timezoneId (timezoneId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CompanyAdmins (id INT UNSIGNED AUTO_INCREMENT NOT NULL, companyId INT UNSIGNED NOT NULL, username VARCHAR(65) NOT NULL COLLATE utf8_general_ci, pass VARCHAR(80) NOT NULL COLLATE utf8_general_ci COMMENT \'[password]\', email VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, active TINYINT(1) DEFAULT \'1\' NOT NULL, timezoneId INT UNSIGNED DEFAULT NULL, name VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci, lastname VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci, INDEX companyId (companyId), INDEX timezoneId (timezoneId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE MainOperators (id INT UNSIGNED AUTO_INCREMENT NOT NULL, username VARCHAR(65) NOT NULL COLLATE utf8_general_ci, pass VARCHAR(80) NOT NULL COLLATE utf8_general_ci COMMENT \'[password]\', email VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, active TINYINT(1) DEFAULT \'1\' NOT NULL, timezoneId INT UNSIGNED DEFAULT NULL, name VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci, lastname VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci, UNIQUE INDEX username (username), INDEX timezoneId (timezoneId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE BrandOperators ADD CONSTRAINT BrandOperators_ibfk_3 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE BrandOperators ADD CONSTRAINT BrandOperators_ibfk_4 FOREIGN KEY (timezoneId) REFERENCES Timezones (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CompanyAdmins ADD CONSTRAINT CompanyAdmins_ibfk_1 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CompanyAdmins ADD CONSTRAINT CompanyAdmins_ibfk_2 FOREIGN KEY (timezoneId) REFERENCES Timezones (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE MainOperators ADD CONSTRAINT MainOperators_ibfk_1 FOREIGN KEY (timezoneId) REFERENCES Timezones (id) ON DELETE SET NULL');

        $this->addSql('INSERT INTO MainOperators (username, pass, email, active, name, lastname, timezoneId) SELECT username, pass, email, active, name, lastname, timezoneId FROM Administrators WHERE companyId IS NULL AND brandId IS NULL');
        $this->addSql('INSERT INTO BrandOperators (username, pass, email, active, name, lastname, timezoneId, brandId) SELECT username, pass, email, active, name, lastname, timezoneId, brandId FROM Administrators WHERE brandId IS NOT NULL');
        $this->addSql('INSERT INTO CompanyAdmins (username, pass, email, active, name, lastname, timezoneId, companyId) SELECT username, pass, email, active, name, lastname, timezoneId, companyId FROM Administrators WHERE companyId IS NOT NULL');

        $this->addSql('DROP TABLE Administrators');
    }
}
