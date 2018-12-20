<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181220182244 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Currencies (id INT UNSIGNED AUTO_INCREMENT NOT NULL, iden VARCHAR(10) NOT NULL, symbol VARCHAR(5) NOT NULL, name_en VARCHAR(25) DEFAULT \'\' NOT NULL, name_es VARCHAR(25) DEFAULT \'\' NOT NULL, UNIQUE INDEX currencyIden (iden), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        $this->addSql('INSERT INTO Currencies (iden, symbol, name_en, name_es) VALUES ("EUR", "€", "Euro", "Euro")');
        $this->addSql('INSERT INTO Currencies (iden, symbol, name_en, name_es) VALUES ("USD", "$", "Dollar", "Dólar")');
        $this->addSql('INSERT INTO Currencies (iden, symbol, name_en, name_es) VALUES ("GBP", "£", "Pound", "Libra")');

        $this->addSql('ALTER TABLE Brands ADD currencyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E410291000B8A FOREIGN KEY (currencyId) REFERENCES Currencies (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_790E410291000B8A ON Brands (currencyId)');

        // Set First currency as default for all existing brands
        $this->addSql('UPDATE Brands set currencyId = 1');

        $this->addSql('ALTER TABLE DestinationRateGroups ADD currencyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DestinationRateGroups ADD CONSTRAINT FK_2930FE1691000B8A FOREIGN KEY (currencyId) REFERENCES Currencies (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_2930FE1691000B8A ON DestinationRateGroups (currencyId)');
        $this->addSql('ALTER TABLE Carriers ADD currencyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Carriers ADD CONSTRAINT FK_F63EC8E391000B8A FOREIGN KEY (currencyId) REFERENCES Currencies (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_F63EC8E391000B8A ON Carriers (currencyId)');
        $this->addSql('ALTER TABLE Companies ADD currencyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B5289991000B8A FOREIGN KEY (currencyId) REFERENCES Currencies (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B5289991000B8A ON Companies (currencyId)');
        $this->addSql('ALTER TABLE RatingPlanGroups ADD currencyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE RatingPlanGroups ADD CONSTRAINT FK_1826169C91000B8A FOREIGN KEY (currencyId) REFERENCES Currencies (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_1826169C91000B8A ON RatingPlanGroups (currencyId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E410291000B8A');
        $this->addSql('ALTER TABLE DestinationRateGroups DROP FOREIGN KEY FK_2930FE1691000B8A');
        $this->addSql('ALTER TABLE Carriers DROP FOREIGN KEY FK_F63EC8E391000B8A');
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B5289991000B8A');
        $this->addSql('ALTER TABLE RatingPlanGroups DROP FOREIGN KEY FK_1826169C91000B8A');
        $this->addSql('DROP TABLE Currencies');
        $this->addSql('DROP INDEX IDX_790E410291000B8A ON Brands');
        $this->addSql('ALTER TABLE Brands DROP currencyId');
        $this->addSql('DROP INDEX IDX_F63EC8E391000B8A ON Carriers');
        $this->addSql('ALTER TABLE Carriers DROP currencyId');
        $this->addSql('DROP INDEX IDX_B5289991000B8A ON Companies');
        $this->addSql('ALTER TABLE Companies DROP currencyId');
        $this->addSql('DROP INDEX IDX_2930FE1691000B8A ON DestinationRateGroups');
        $this->addSql('ALTER TABLE DestinationRateGroups DROP currencyId');
        $this->addSql('DROP INDEX IDX_1826169C91000B8A ON RatingPlanGroups');
        $this->addSql('ALTER TABLE RatingPlanGroups DROP currencyId');
    }
}

