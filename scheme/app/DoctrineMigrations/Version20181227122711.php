<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181227122711 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX dateCalendar ON HolidayDates');
        $this->addSql('ALTER TABLE HolidayDates ADD wholeDayEvent TINYINT(1) DEFAULT \'1\' NOT NULL, ADD timeIn TIME DEFAULT NULL, ADD timeOut TIME DEFAULT NULL, ADD routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:number|extension|voicemail]\', ADD numberValue VARCHAR(25) DEFAULT NULL, ADD extensionId INT UNSIGNED DEFAULT NULL, ADD voiceMailUserId INT UNSIGNED DEFAULT NULL, ADD numberCountryId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE HolidayDates ADD CONSTRAINT FK_4C57128012AB7F65 FOREIGN KEY (extensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE HolidayDates ADD CONSTRAINT FK_4C571280AF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE HolidayDates ADD CONSTRAINT FK_4C571280D7819488 FOREIGN KEY (numberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_4C57128012AB7F65 ON HolidayDates (extensionId)');
        $this->addSql('CREATE INDEX IDX_4C571280AF230FFD ON HolidayDates (voiceMailUserId)');
        $this->addSql('CREATE INDEX IDX_4C571280D7819488 ON HolidayDates (numberCountryId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE HolidayDates DROP FOREIGN KEY FK_4C57128012AB7F65');
        $this->addSql('ALTER TABLE HolidayDates DROP FOREIGN KEY FK_4C571280AF230FFD');
        $this->addSql('ALTER TABLE HolidayDates DROP FOREIGN KEY FK_4C571280D7819488');
        $this->addSql('DROP INDEX IDX_4C57128012AB7F65 ON HolidayDates');
        $this->addSql('DROP INDEX IDX_4C571280AF230FFD ON HolidayDates');
        $this->addSql('DROP INDEX IDX_4C571280D7819488 ON HolidayDates');
        $this->addSql('ALTER TABLE HolidayDates DROP wholeDayEvent, DROP timeIn, DROP timeOut, DROP routeType, DROP numberValue, DROP extensionId, DROP voiceMailUserId, DROP numberCountryId');
        $this->addSql('CREATE UNIQUE INDEX dateCalendar ON HolidayDates (eventDate, calendarId)');
    }
}
