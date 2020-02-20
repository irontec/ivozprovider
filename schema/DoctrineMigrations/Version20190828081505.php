<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190828081505 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DestinationRateGroups ADD name_it VARCHAR(55) NOT NULL AFTER name_ca, ADD description_it VARCHAR(255) NOT NULL AFTER description_ca');
        $this->addSql('ALTER TABLE Languages ADD name_it VARCHAR(100) DEFAULT \'\' NOT NULL AFTER name_ca');
        $this->addSql('ALTER TABLE Timezones ADD timeZoneLabel_it VARCHAR(20) DEFAULT \'\' NOT NULL AFTER timeZoneLabel_ca');
        $this->addSql('ALTER TABLE Currencies ADD name_it VARCHAR(25) DEFAULT \'\' NOT NULL AFTER name_ca');
        $this->addSql('ALTER TABLE RoutingPatterns ADD name_it VARCHAR(55) NOT NULL AFTER name_ca, ADD description_it VARCHAR(55) DEFAULT NULL AFTER description_ca');
        $this->addSql('ALTER TABLE Destinations ADD name_it VARCHAR(100) DEFAULT NULL AFTER name_ca');
        $this->addSql('ALTER TABLE Features ADD name_it VARCHAR(50) DEFAULT \'\' NOT NULL AFTER name_ca');
        $this->addSql('ALTER TABLE TransformationRuleSets ADD name_it VARCHAR(100) NOT NULL AFTER name_ca');
        $this->addSql('ALTER TABLE RatingPlanGroups ADD name_it VARCHAR(55) NOT NULL AFTER name_ca, ADD description_it VARCHAR(255) NOT NULL AFTER description_ca');
        $this->addSql('ALTER TABLE Countries ADD name_it VARCHAR(100) DEFAULT NULL AFTER name_ca, ADD zone_it VARCHAR(55) DEFAULT \'\' NOT NULL AFTER zone_ca');
        $this->addSql('ALTER TABLE Services ADD name_it VARCHAR(50) DEFAULT \'\' NOT NULL AFTER name_ca, ADD description_it VARCHAR(255) DEFAULT \'\' NOT NULL AFTER description_ca');

        $this->addSql('INSERT INTO Languages (iden, name_en, name_es, name_ca, name_it)
                              VALUES ("it", "Italian", "Italiano", "Italià", "Italiano")');
        $this->addSql('UPDATE Languages SET name_it = "Spagnolo" WHERE iden = "es"');
        $this->addSql('UPDATE Languages SET name_it = "Inglese" WHERE iden = "en"');
        $this->addSql('UPDATE Languages SET name_it = "Catalano" WHERE iden = "ca"');

        $this->addSql('UPDATE DestinationRateGroups SET name_it = name_en, description_it = description_en');
        $this->addSql('UPDATE Currencies SET name_it = name_en');
        $this->addSql('UPDATE RoutingPatterns SET name_it = name_en, description_it = description_en');
        $this->addSql('UPDATE Destinations SET name_it = name_en');
        $this->addSql('UPDATE Features SET name_it = name_en');
        $this->addSql('UPDATE TransformationRuleSets SET name_it = name_en');
        $this->addSql('UPDATE RatingPlanGroups SET name_it = name_en, description_it = description_en');
        $this->addSql('UPDATE Countries SET name_it = name_en, zone_it = zone_en');
        $this->addSql('UPDATE Services SET name_it = name_en, description_it = description_en');
   }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Countries DROP name_it, DROP zone_it');
        $this->addSql('ALTER TABLE Currencies DROP name_it');
        $this->addSql('ALTER TABLE DestinationRateGroups DROP name_it, DROP description_it');
        $this->addSql('ALTER TABLE Destinations DROP name_it');
        $this->addSql('ALTER TABLE Features DROP name_it');
        $this->addSql('ALTER TABLE Languages DROP name_it');
        $this->addSql('ALTER TABLE RatingPlanGroups DROP name_it, DROP description_it');
        $this->addSql('ALTER TABLE RoutingPatterns DROP name_it, DROP description_it');
        $this->addSql('ALTER TABLE Services DROP name_it, DROP description_it');
        $this->addSql('ALTER TABLE Timezones DROP timeZoneLabel_it');
        $this->addSql('ALTER TABLE TransformationRuleSets DROP name_it');
    }
}
