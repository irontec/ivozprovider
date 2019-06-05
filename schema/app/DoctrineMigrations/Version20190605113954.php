<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190605113954 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DestinationRateGroups ADD name_ca VARCHAR(55) NOT NULL AFTER name_es, ADD description_ca VARCHAR(255) NOT NULL AFTER description_es');
        $this->addSql('ALTER TABLE Languages ADD name_ca VARCHAR(100) DEFAULT \'\' NOT NULL AFTER name_es');
        $this->addSql('ALTER TABLE Timezones ADD timeZoneLabel_ca VARCHAR(20) DEFAULT \'\' NOT NULL AFTER timeZoneLabel_es');
        $this->addSql('ALTER TABLE Currencies ADD name_ca VARCHAR(25) DEFAULT \'\' NOT NULL AFTER name_es');
        $this->addSql('ALTER TABLE RoutingPatterns ADD name_ca VARCHAR(55) NOT NULL AFTER name_es, ADD description_ca VARCHAR(55) DEFAULT NULL AFTER description_es');
        $this->addSql('ALTER TABLE Destinations ADD name_ca VARCHAR(100) DEFAULT NULL AFTER name_es');
        $this->addSql('ALTER TABLE Features ADD name_ca VARCHAR(50) DEFAULT \'\' NOT NULL AFTER name_es');
        $this->addSql('ALTER TABLE TransformationRuleSets ADD name_ca VARCHAR(100) NOT NULL AFTER name_es');
        $this->addSql('ALTER TABLE RatingPlanGroups ADD name_ca VARCHAR(55) NOT NULL AFTER name_es, ADD description_ca VARCHAR(255) NOT NULL AFTER description_es');
        $this->addSql('ALTER TABLE Countries ADD name_ca VARCHAR(100) DEFAULT NULL AFTER name_es, ADD zone_ca VARCHAR(55) DEFAULT \'\' NOT NULL AFTER zone_es');
        $this->addSql('ALTER TABLE Services ADD name_ca VARCHAR(50) DEFAULT \'\' NOT NULL AFTER name_es, ADD description_ca VARCHAR(255) DEFAULT \'\' NOT NULL AFTER description_es');

        $this->addSql('INSERT INTO Languages (iden, name_en, name_es, name_ca)
                              VALUES ("ca", "Catalan", "Catalán", "Català")');
        $this->addSql('UPDATE Languages SET name_ca = "Castellà" WHERE iden = "es"');
        $this->addSql('UPDATE Languages SET name_ca = "Anglès" WHERE iden = "en"');

        $this->addSql('UPDATE DestinationRateGroups SET name_ca = name_es, description_ca = description_es');
        $this->addSql('UPDATE Currencies SET name_ca = name_es');
        $this->addSql('UPDATE RoutingPatterns SET name_ca = name_es, description_ca = description_es');
        $this->addSql('UPDATE Destinations SET name_ca = name_es');
        $this->addSql('UPDATE Features SET name_ca = name_es');
        $this->addSql('UPDATE TransformationRuleSets SET name_ca = name_es');
        $this->addSql('UPDATE RatingPlanGroups SET name_ca = name_es, description_ca = description_es');
        $this->addSql('UPDATE Countries SET name_ca = name_es, zone_ca = zone_es');
        $this->addSql('UPDATE Services SET name_ca = name_es, description_ca = description_es');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Countries DROP name_ca');
        $this->addSql('ALTER TABLE Currencies DROP name_ca');
        $this->addSql('ALTER TABLE DestinationRateGroups DROP name_ca, DROP description_ca');
        $this->addSql('ALTER TABLE Destinations DROP name_ca');
        $this->addSql('ALTER TABLE Features DROP name_ca');
        $this->addSql('ALTER TABLE Languages DROP name_ca');
        $this->addSql('ALTER TABLE RatingPlanGroups DROP name_ca, DROP description_ca, DROP zone_ca');
        $this->addSql('ALTER TABLE RoutingPatterns DROP name_ca, DROP description_ca');
        $this->addSql('ALTER TABLE Services DROP name_ca, DROP description_ca');
        $this->addSql('ALTER TABLE TransformationRuleSets DROP name_ca');
    }
}
