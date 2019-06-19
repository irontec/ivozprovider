<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190617101841 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE CalendarPeriodsRelSchedules (id INT UNSIGNED AUTO_INCREMENT NOT NULL, conditionId INT UNSIGNED NOT NULL, scheduleId INT UNSIGNED NOT NULL, INDEX IDX_A4FBF3A7128AE9F0 (conditionId), INDEX IDX_A4FBF3A7B745014E (scheduleId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CalendarPeriods (id INT UNSIGNED AUTO_INCREMENT NOT NULL, startDate DATE NOT NULL, endDate DATE NOT NULL, routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:number|extension|voicemail]\', numberValue VARCHAR(25) DEFAULT NULL, calendarId INT UNSIGNED NOT NULL, locutionId INT UNSIGNED DEFAULT NULL, extensionId INT UNSIGNED DEFAULT NULL, voiceMailUserId INT UNSIGNED DEFAULT NULL, numberCountryId INT UNSIGNED DEFAULT NULL, INDEX IDX_733A607F2D4F56A6 (calendarId), INDEX IDX_733A607F54690B0 (locutionId), INDEX IDX_733A607F12AB7F65 (extensionId), INDEX IDX_733A607FAF230FFD (voiceMailUserId), INDEX IDX_733A607FD7819488 (numberCountryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE CalendarPeriodsRelSchedules ADD CONSTRAINT FK_A4FBF3A7128AE9F0 FOREIGN KEY (conditionId) REFERENCES CalendarPeriods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CalendarPeriodsRelSchedules ADD CONSTRAINT FK_A4FBF3A7B745014E FOREIGN KEY (scheduleId) REFERENCES Schedules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CalendarPeriods ADD CONSTRAINT FK_733A607F2D4F56A6 FOREIGN KEY (calendarId) REFERENCES Calendars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CalendarPeriods ADD CONSTRAINT FK_733A607F54690B0 FOREIGN KEY (locutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CalendarPeriods ADD CONSTRAINT FK_733A607F12AB7F65 FOREIGN KEY (extensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CalendarPeriods ADD CONSTRAINT FK_733A607FAF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CalendarPeriods ADD CONSTRAINT FK_733A607FD7819488 FOREIGN KEY (numberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CalendarPeriodsRelSchedules DROP FOREIGN KEY FK_A4FBF3A7128AE9F0');
        $this->addSql('DROP TABLE CalendarPeriodsRelSchedules');
        $this->addSql('DROP TABLE CalendarPeriods');
    }
}
