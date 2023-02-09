<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308132214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generic Voicemail support';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Voicemails (
              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
              enabled TINYINT(1) UNSIGNED DEFAULT \'1\' NOT NULL,
              userId INT UNSIGNED DEFAULT NULL,
              residentialDeviceId INT UNSIGNED DEFAULT NULL,
              companyId INT UNSIGNED NOT NULL,
              name VARCHAR(200) NOT NULL,
              email VARCHAR(200) DEFAULT NULL,
              sendMail TINYINT(1) UNSIGNED DEFAULT \'0\' NOT NULL,
              attachSound TINYINT(1) UNSIGNED DEFAULT \'1\' NOT NULL,
              locutionId INT UNSIGNED DEFAULT NULL,
          UNIQUE INDEX voicemail_user (userId),
          UNIQUE INDEX voicemail_residential (residentialDeviceId),
          INDEX IDX_5CE374152480E723 (companyId),
          INDEX IDX_5CE3741554690B0 (locutionId),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET UTF8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Voicemails ADD CONSTRAINT FK_5CE3741564B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Voicemails ADD CONSTRAINT FK_5CE374158B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Voicemails ADD CONSTRAINT FK_5CE374152480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Voicemails ADD CONSTRAINT FK_5CE3741554690B0 FOREIGN KEY (locutionId) REFERENCES Locutions (id) ON DELETE SET NULL');

        // Load Users and Residential Voicemails
        $this->addSql('INSERT INTO Voicemails (id, name, email, enabled, sendMail, attachSound, userId, companyId, locutionId) SELECT id, CONCAT(name, " ", lastname), email, voicemailEnabled, voicemailSendMail, voicemailAttachSound,
id, companyId, voicemailLocutionId FROM Users');
        $this->addSql('INSERT INTO Voicemails (name, residentialDeviceId, companyId) SELECT name, id, companyId FROM ResidentialDevices');

        //! CalendarPeriods
        $this->addSql('ALTER TABLE CalendarPeriods DROP FOREIGN KEY FK_733A607FAF230FFD');
        $this->addSql('DROP INDEX IDX_733A607FAF230FFD ON CalendarPeriods');
        $this->addSql('ALTER TABLE CalendarPeriods CHANGE voicemailuserid voicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CalendarPeriods ADD CONSTRAINT FK_733A607F56691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_733A607F56691CFD ON CalendarPeriods (voicemailId)');

        //! CallForwardSettings
        $this->addSql('ALTER TABLE CallForwardSettings DROP FOREIGN KEY CallForwardSettings_ibfk_3');
        $this->addSql('DROP INDEX IDX_E71B58A4AF230FFD ON CallForwardSettings');
        $this->addSql('ALTER TABLE CallForwardSettings CHANGE voicemailuserid voicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CallForwardSettings ADD CONSTRAINT FK_E71B58A456691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_E71B58A456691CFD ON CallForwardSettings (voicemailId)');

        //! ConditionalRoutes
        $this->addSql('ALTER TABLE ConditionalRoutes DROP FOREIGN KEY FK_AFB65F0DAF230FFD');
        $this->addSql('DROP INDEX IDX_AFB65F0DAF230FFD ON ConditionalRoutes');
        $this->addSql('ALTER TABLE ConditionalRoutes CHANGE voicemailuserid voicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD CONSTRAINT FK_AFB65F0D56691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AFB65F0D56691CFD ON ConditionalRoutes (voicemailId)');

        //! ConditionalRoutesConditions
        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP FOREIGN KEY FK_425473C9AF230FFD');
        $this->addSql('DROP INDEX IDX_425473C9AF230FFD ON ConditionalRoutesConditions');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions CHANGE voicemailuserid voicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD CONSTRAINT FK_425473C956691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_425473C956691CFD ON ConditionalRoutesConditions (voicemailId)');

        //! ExternalCallFilters
        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY ExternalCallFilters_ibfk_7');
        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY ExternalCallFilters_ibfk_8');
        $this->addSql('DROP INDEX IDX_528CEED9D66AD272 ON ExternalCallFilters');
        $this->addSql('DROP INDEX IDX_528CEED9DF7207AC ON ExternalCallFilters');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD holidayVoicemailId INT UNSIGNED DEFAULT NULL, ADD outOfScheduleVoicemailId INT UNSIGNED DEFAULT NULL, DROP holidayVoiceMailUserId, DROP outOfScheduleVoiceMailUserId');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT FK_528CEED9CC4C5B43 FOREIGN KEY (holidayVoicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT FK_528CEED9BE0071BC FOREIGN KEY (outOfScheduleVoicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_528CEED9CC4C5B43 ON ExternalCallFilters (holidayVoicemailId)');
        $this->addSql('CREATE INDEX IDX_528CEED9BE0071BC ON ExternalCallFilters (outOfScheduleVoicemailId)');

        //! HolidayDates
        $this->addSql('ALTER TABLE HolidayDates DROP FOREIGN KEY FK_4C571280AF230FFD');
        $this->addSql('DROP INDEX IDX_4C571280AF230FFD ON HolidayDates');
        $this->addSql('ALTER TABLE HolidayDates CHANGE voicemailuserid voicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE HolidayDates ADD CONSTRAINT FK_4C57128056691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_4C57128056691CFD ON HolidayDates (voicemailId)');

        //! HuntGroups
        $this->addSql('ALTER TABLE HuntGroups DROP FOREIGN KEY HuntGroups_ibfk_4');
        $this->addSql('DROP INDEX IDX_4F9672EC87167A2E ON HuntGroups');
        $this->addSql('ALTER TABLE HuntGroups CHANGE noanswervoicemailuserid noAnswerVoicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE HuntGroups ADD CONSTRAINT FK_4F9672ECF3201D6 FOREIGN KEY (noAnswerVoicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_4F9672ECF3201D6 ON HuntGroups (noAnswerVoicemailId)');

        //! IVREntries
        $this->addSql('ALTER TABLE IVREntries DROP FOREIGN KEY FK_E847DD7CAF230FFD');
        $this->addSql('DROP INDEX IDX_E847DD7CAF230FFD ON IVREntries');
        $this->addSql('ALTER TABLE IVREntries CHANGE voicemailuserid voicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7C56691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_E847DD7C56691CFD ON IVREntries (voicemailId)');

        //! IVRs
        $this->addSql('ALTER TABLE IVRs DROP FOREIGN KEY FK_EEE885F99ED32186');
        $this->addSql('ALTER TABLE IVRs DROP FOREIGN KEY FK_EEE885F9D60923A6');
        $this->addSql('DROP INDEX IDX_EEE885F99ED32186 ON IVRs');
        $this->addSql('DROP INDEX IDX_EEE885F9D60923A6 ON IVRs');
        $this->addSql('ALTER TABLE IVRs CHANGE noInputVoiceMailUserId noInputVoicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE IVRs CHANGE errorVoiceMailUserId errorVoicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F9A1583062 FOREIGN KEY (noInputVoicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F950F835D7 FOREIGN KEY (errorVoicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_EEE885F9A1583062 ON IVRs (noInputVoicemailId)');
        $this->addSql('CREATE INDEX IDX_EEE885F950F835D7 ON IVRs (errorVoicemailId)');

        //! Queues
        $this->addSql('ALTER TABLE Queues DROP FOREIGN KEY Queues_ibfk_5');
        $this->addSql('ALTER TABLE Queues DROP FOREIGN KEY Queues_ibfk_8');
        $this->addSql('DROP INDEX IDX_C86607A07030598F ON Queues');
        $this->addSql('DROP INDEX IDX_C86607A08961FE7B ON Queues');
        $this->addSql('ALTER TABLE Queues CHANGE timeoutVoiceMailUserId timeoutVoicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Queues CHANGE fullVoiceMailUserId fullVoicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Queues ADD CONSTRAINT FK_C86607A017960763 FOREIGN KEY (timeoutVoicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Queues ADD CONSTRAINT FK_C86607A0DBB82F34 FOREIGN KEY (fullVoicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_C86607A017960763 ON Queues (timeoutVoicemailId)');
        $this->addSql('CREATE INDEX IDX_C86607A0DBB82F34 ON Queues (fullVoicemailId)');

        //! Extensions
        $this->addSql('ALTER TABLE Extensions ADD voicemailId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Extensions ADD CONSTRAINT FK_9AAD9F7956691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_9AAD9F7956691CFD ON Extensions (voicemailId)');
        $this->addSql('ALTER TABLE Extensions CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|ivr|huntGroup|conferenceRoom|friend|queue|conditional|voicemail]\'');

        //! ast_voicemail
        $this->addSql('ALTER TABLE ast_voicemail DROP FOREIGN KEY ast_voicemail_ibfk_1');
        $this->addSql('ALTER TABLE ast_voicemail DROP FOREIGN KEY FK_B2AD1D0A8B329DCD');
        $this->addSql('DROP INDEX voicemail_residential_device ON ast_voicemail');
        $this->addSql('DROP INDEX voicemail_user ON ast_voicemail');
        $this->addSql('ALTER TABLE ast_voicemail ADD voicemailId INT UNSIGNED DEFAULT NULL');

        // Update ast_voicemail fields before removing user and residential keys
        $this->addSql('UPDATE ast_voicemail AV INNER JOIN Voicemails V ON V.userId = AV.userId SET voicemailId = V.id');
        $this->addSql('UPDATE ast_voicemail AV INNER JOIN Voicemails V ON V.residentialDeviceId = AV.residentialDeviceId SET voicemailId = V.id');

        $this->addSql('ALTER TABLE ast_voicemail DROP userId, DROP residentialDeviceId');
        $this->addSql('ALTER TABLE ast_voicemail ADD CONSTRAINT FK_B2AD1D0A56691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX voicemail_voicemail ON ast_voicemail (voicemailId)');

        $this->addSql('ALTER TABLE Users DROP FOREIGN KEY Users_ibfk_15');
        $this->addSql('DROP INDEX IDX_D5428AEDF32B4B65 ON Users');
        $this->addSql('ALTER TABLE Users DROP voicemailEnabled, DROP voicemailLocutionId, DROP voicemailSendMail, DROP voicemailAttachSound');

        // Add new Public entity data
        $this->addSql("INSERT INTO PublicEntities 
                (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it)
            VALUES
                ('Voicemails', 'Ivoz\Provider\Domain\Model\Voicemail\Voicemail', 0, 0, 1, 'Voicemails', 'Buzones de voz', 'Buzones de voz', 'Voicemails')"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE CalendarPeriods DROP FOREIGN KEY FK_733A607F56691CFD');
        $this->addSql('ALTER TABLE CallForwardSettings DROP FOREIGN KEY FK_E71B58A456691CFD');
        $this->addSql('ALTER TABLE ConditionalRoutes DROP FOREIGN KEY FK_AFB65F0D56691CFD');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP FOREIGN KEY FK_425473C956691CFD');
        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY FK_528CEED9CC4C5B43');
        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY FK_528CEED9BE0071BC');
        $this->addSql('ALTER TABLE HolidayDates DROP FOREIGN KEY FK_4C57128056691CFD');
        $this->addSql('ALTER TABLE HuntGroups DROP FOREIGN KEY FK_4F9672ECF3201D6');
        $this->addSql('ALTER TABLE IVREntries DROP FOREIGN KEY FK_E847DD7C56691CFD');
        $this->addSql('ALTER TABLE IVRs DROP FOREIGN KEY FK_EEE885F9A1583062');
        $this->addSql('ALTER TABLE IVRs DROP FOREIGN KEY FK_EEE885F950F835D7');
        $this->addSql('ALTER TABLE Queues DROP FOREIGN KEY FK_C86607A017960763');
        $this->addSql('ALTER TABLE Queues DROP FOREIGN KEY FK_C86607A0DBB82F34');
        $this->addSql('ALTER TABLE ast_voicemail DROP FOREIGN KEY FK_B2AD1D0A56691CFD');
        $this->addSql('DROP TABLE Voicemails');
        $this->addSql('DROP INDEX IDX_733A607F56691CFD ON CalendarPeriods');
        $this->addSql('ALTER TABLE CalendarPeriods CHANGE voicemailid voiceMailUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CalendarPeriods ADD CONSTRAINT FK_733A607FAF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_733A607FAF230FFD ON CalendarPeriods (voiceMailUserId)');
        $this->addSql('DROP INDEX IDX_E71B58A456691CFD ON CallForwardSettings');
        $this->addSql('ALTER TABLE CallForwardSettings CHANGE voicemailid voiceMailUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CallForwardSettings ADD CONSTRAINT CallForwardSettings_ibfk_3 FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_E71B58A4AF230FFD ON CallForwardSettings (voiceMailUserId)');
        $this->addSql('DROP INDEX IDX_AFB65F0D56691CFD ON ConditionalRoutes');
        $this->addSql('ALTER TABLE ConditionalRoutes CHANGE voicemailid voiceMailUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD CONSTRAINT FK_AFB65F0DAF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AFB65F0DAF230FFD ON ConditionalRoutes (voiceMailUserId)');
        $this->addSql('DROP INDEX IDX_425473C956691CFD ON ConditionalRoutesConditions');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions CHANGE voicemailid voiceMailUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD CONSTRAINT FK_425473C9AF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_425473C9AF230FFD ON ConditionalRoutesConditions (voiceMailUserId)');
        $this->addSql('DROP INDEX IDX_528CEED9CC4C5B43 ON ExternalCallFilters');
        $this->addSql('DROP INDEX IDX_528CEED9BE0071BC ON ExternalCallFilters');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD holidayVoiceMailUserId INT UNSIGNED DEFAULT NULL, ADD outOfScheduleVoiceMailUserId INT UNSIGNED DEFAULT NULL, DROP holidayVoicemailId, DROP outOfScheduleVoicemailId');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT ExternalCallFilters_ibfk_7 FOREIGN KEY (holidayVoiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT ExternalCallFilters_ibfk_8 FOREIGN KEY (outOfScheduleVoiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_528CEED9D66AD272 ON ExternalCallFilters (outOfScheduleVoiceMailUserId)');
        $this->addSql('CREATE INDEX IDX_528CEED9DF7207AC ON ExternalCallFilters (holidayVoiceMailUserId)');
        $this->addSql('DROP INDEX IDX_4C57128056691CFD ON HolidayDates');
        $this->addSql('ALTER TABLE HolidayDates CHANGE voicemailid voiceMailUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE HolidayDates ADD CONSTRAINT FK_4C571280AF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_4C571280AF230FFD ON HolidayDates (voiceMailUserId)');
        $this->addSql('DROP INDEX IDX_4F9672ECF3201D6 ON HuntGroups');
        $this->addSql('ALTER TABLE HuntGroups CHANGE noanswervoicemailid noAnswerVoiceMailUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE HuntGroups ADD CONSTRAINT HuntGroups_ibfk_4 FOREIGN KEY (noAnswerVoiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_4F9672EC87167A2E ON HuntGroups (noAnswerVoiceMailUserId)');
        $this->addSql('DROP INDEX IDX_E847DD7C56691CFD ON IVREntries');
        $this->addSql('ALTER TABLE IVREntries CHANGE voicemailid voiceMailUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7CAF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_E847DD7CAF230FFD ON IVREntries (voiceMailUserId)');
        $this->addSql('DROP INDEX IDX_EEE885F9A1583062 ON IVRs');
        $this->addSql('DROP INDEX IDX_EEE885F950F835D7 ON IVRs');
        $this->addSql('ALTER TABLE IVRs ADD noInputVoiceMailUserId INT UNSIGNED DEFAULT NULL, ADD errorVoiceMailUserId INT UNSIGNED DEFAULT NULL, DROP noInputVoicemailId, DROP errorVoicemailId');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F99ED32186 FOREIGN KEY (noInputVoiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F9D60923A6 FOREIGN KEY (errorVoiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_EEE885F99ED32186 ON IVRs (noInputVoiceMailUserId)');
        $this->addSql('CREATE INDEX IDX_EEE885F9D60923A6 ON IVRs (errorVoiceMailUserId)');
        $this->addSql('DROP INDEX IDX_C86607A017960763 ON Queues');
        $this->addSql('DROP INDEX IDX_C86607A0DBB82F34 ON Queues');
        $this->addSql('ALTER TABLE Queues ADD timeoutVoiceMailUserId INT UNSIGNED DEFAULT NULL, ADD fullVoiceMailUserId INT UNSIGNED DEFAULT NULL, DROP timeoutVoicemailId, DROP fullVoicemailId');
        $this->addSql('ALTER TABLE Queues ADD CONSTRAINT Queues_ibfk_5 FOREIGN KEY (timeoutVoiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Queues ADD CONSTRAINT Queues_ibfk_8 FOREIGN KEY (fullVoiceMailUserId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_C86607A07030598F ON Queues (timeoutVoiceMailUserId)');
        $this->addSql('CREATE INDEX IDX_C86607A08961FE7B ON Queues (fullVoiceMailUserId)');
        $this->addSql('ALTER TABLE Extensions DROP FOREIGN KEY FK_9AAD9F7956691CFD');
        $this->addSql('DROP INDEX IDX_9AAD9F7956691CFD ON Extensions');
        $this->addSql('ALTER TABLE Extensions DROP voicemailId');
        $this->addSql('ALTER TABLE Extensions CHANGE routeType routeType VARCHAR(25) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci` COMMENT \'[enum:user|number|ivr|huntGroup|conferenceRoom|friend|queue|conditional]\'');
        $this->addSql('DROP INDEX voicemail_voicemail ON ast_voicemail');
        $this->addSql('ALTER TABLE ast_voicemail ADD residentialDeviceId INT UNSIGNED DEFAULT NULL, CHANGE voicemailid userId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ast_voicemail ADD CONSTRAINT ast_voicemail_ibfk_1 FOREIGN KEY (userId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ast_voicemail ADD CONSTRAINT FK_B2AD1D0A8B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX voicemail_residential_device ON ast_voicemail (residentialDeviceId)');
        $this->addSql('CREATE UNIQUE INDEX voicemail_user ON ast_voicemail (userId)');
        $this->addSql('ALTER TABLE Users ADD voicemailLocutionId INT UNSIGNED DEFAULT NULL, ADD voicemailSendMail TINYINT(1) DEFAULT \'0\' NOT NULL, ADD voicemailAttachSound TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE Users ADD CONSTRAINT Users_ibfk_15 FOREIGN KEY (voicemailLocutionId) REFERENCES Locutions (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_D5428AEDF32B4B65 ON Users (voicemailLocutionId)');
    }
}
