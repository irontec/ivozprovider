<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20260109133027 extends LoggableMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Countries ADD name_eu VARCHAR(100) NOT NULL, ADD zone_eu VARCHAR(55) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE Currencies ADD name_eu VARCHAR(25) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE DestinationRateGroups ADD name_eu VARCHAR(55) NOT NULL, ADD description_eu VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Destinations ADD name_eu VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE Features ADD name_eu VARCHAR(50) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE Languages ADD name_eu VARCHAR(100) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE PublicEntities ADD name_eu VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE RatingPlanGroups ADD name_eu VARCHAR(55) NOT NULL, ADD description_eu VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE RoutingPatterns ADD name_eu VARCHAR(55) NOT NULL, ADD description_eu VARCHAR(55) DEFAULT NULL');
        $this->addSql('ALTER TABLE Services ADD name_eu VARCHAR(50) DEFAULT \'\' NOT NULL, ADD description_eu VARCHAR(255) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE Timezones ADD timeZoneLabel_eu VARCHAR(20) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE TransformationRuleSets ADD name_eu VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Countries DROP name_eu, DROP zone_eu');
        $this->addSql('ALTER TABLE Currencies DROP name_eu');
        $this->addSql('ALTER TABLE DestinationRateGroups DROP name_eu, DROP description_eu');
        $this->addSql('ALTER TABLE Destinations DROP name_eu');
        $this->addSql('ALTER TABLE Features DROP name_eu');
        $this->addSql('ALTER TABLE Languages DROP name_eu');
        $this->addSql('ALTER TABLE PublicEntities DROP name_eu');
        $this->addSql('ALTER TABLE RatingPlanGroups DROP name_eu, DROP description_eu');
        $this->addSql('ALTER TABLE RoutingPatterns DROP name_eu, DROP description_eu');
        $this->addSql('ALTER TABLE Services DROP name_eu, DROP description_eu');
        $this->addSql('ALTER TABLE Timezones DROP timeZoneLabel_eu');
        $this->addSql('ALTER TABLE TransformationRuleSets DROP name_eu');
    }
}