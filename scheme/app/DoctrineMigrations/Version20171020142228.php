<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171020142228 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallForwardSettings ADD numberCountryId INT UNSIGNED DEFAULT NULL AFTER targetType');
        $this->addSql('ALTER TABLE CallForwardSettings ADD CONSTRAINT FK_E71B58A4D7819488 FOREIGN KEY (numberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_E71B58A4D7819488 ON CallForwardSettings (numberCountryId)');
        $this->addSql('UPDATE CallForwardSettings SET numberCountryId = (SELECT countryId FROM Users WHERE Users.id = CallForwardSettings.userId) WHERE numberValue IS NOT NULL');

        $this->addSql('ALTER TABLE ExternalCallFilters ADD holidayNumberCountryId INT UNSIGNED DEFAULT NULL AFTER holidayTargetType');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD outOfScheduleNumberCountryId INT UNSIGNED DEFAULT NULL AFTER outOfScheduleTargetType');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT FK_528CEED9A7D09CD9 FOREIGN KEY (holidayNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT FK_528CEED9AEC84907 FOREIGN KEY (outOfScheduleNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_528CEED9A7D09CD9 ON ExternalCallFilters (holidayNumberCountryId)');
        $this->addSql('CREATE INDEX IDX_528CEED9AEC84907 ON ExternalCallFilters (outOfScheduleNumberCountryId)');
        $this->addSql('UPDATE ExternalCallFilters SET holidayNumberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = ExternalCallFilters.companyId) WHERE holidayNumberValue IS NOT NULL');
        $this->addSql('UPDATE ExternalCallFilters SET outOfScheduleNumberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = ExternalCallFilters.companyId) WHERE outOfScheduleNumberValue IS NOT NULL');

        $this->addSql('ALTER TABLE Extensions ADD numberCountryId INT UNSIGNED DEFAULT NULL AFTER userId');
        $this->addSql('ALTER TABLE Extensions ADD CONSTRAINT FK_9AAD9F79D7819488 FOREIGN KEY (numberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_9AAD9F79D7819488 ON Extensions (numberCountryId)');
        $this->addSql('UPDATE Extensions SET numberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = Extensions.companyId)  WHERE numberValue IS NOT NULL');

        $this->addSql('ALTER TABLE ConditionalRoutes ADD numberCountryId INT UNSIGNED DEFAULT NULL AFTER userId');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD CONSTRAINT FK_AFB65F0DD7819488 FOREIGN KEY (numberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AFB65F0DD7819488 ON ConditionalRoutes (numberCountryId)');
        $this->addSql('UPDATE ConditionalRoutes SET numberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = ConditionalRoutes.companyId)  WHERE numberValue IS NOT NULL');

        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD numberCountryId INT UNSIGNED DEFAULT NULL AFTER userId');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD CONSTRAINT FK_425473C9D7819488 FOREIGN KEY (numberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_425473C9D7819488 ON ConditionalRoutesConditions (numberCountryId)');
        $this->addSql('UPDATE ConditionalRoutesConditions SET numberCountryId = (SELECT Companies.countryId FROM Companies INNER JOIN ConditionalRoutes ON ConditionalRoutes.companyId = Companies.id WHERE ConditionalRoutes.id = conditionalRouteId)');

        $this->addSql('ALTER TABLE IVRCommon ADD timeoutNumberCountryId INT UNSIGNED DEFAULT NULL AFTER timeoutTargetType');
        $this->addSql('ALTER TABLE IVRCommon ADD errorNumberCountryId INT UNSIGNED DEFAULT NULL AFTER errorTargetType');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT FK_E0B977E9892C2FA FOREIGN KEY (timeoutNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT FK_E0B977E9AEABB8D3 FOREIGN KEY (errorNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_E0B977E9892C2FA ON IVRCommon (timeoutNumberCountryId)');
        $this->addSql('CREATE INDEX IDX_E0B977E9AEABB8D3 ON IVRCommon (errorNumberCountryId)');
        $this->addSql('UPDATE IVRCommon SET timeoutNumberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = IVRCommon.companyId)  WHERE timeoutNumberValue IS NOT NULL');
        $this->addSql('UPDATE IVRCommon SET errorNumberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = IVRCommon.companyId)  WHERE errorNumberValue IS NOT NULL');

        $this->addSql('ALTER TABLE IVRCustom ADD timeoutNumberCountryId INT UNSIGNED DEFAULT NULL AFTER timeoutTargetType');
        $this->addSql('ALTER TABLE IVRCustom ADD errorNumberCountryId INT UNSIGNED DEFAULT NULL AFTER errorTargetType');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT FK_F0D11123892C2FA FOREIGN KEY (timeoutNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT FK_F0D11123AEABB8D3 FOREIGN KEY (errorNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_F0D11123892C2FA ON IVRCustom (timeoutNumberCountryId)');
        $this->addSql('CREATE INDEX IDX_F0D11123AEABB8D3 ON IVRCustom (errorNumberCountryId)');
        $this->addSql('UPDATE IVRCustom SET timeoutNumberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = IVRCustom.companyId)  WHERE timeoutNumberValue IS NOT NULL');
        $this->addSql('UPDATE IVRCustom SET errorNumberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = IVRCustom.companyId)  WHERE errorNumberValue IS NOT NULL');

        $this->addSql('ALTER TABLE IVRCustomEntries ADD targetNumberCountryId INT UNSIGNED DEFAULT NULL AFTER targetType');
        $this->addSql('ALTER TABLE IVRCustomEntries ADD CONSTRAINT FK_E66938283F47F8B0 FOREIGN KEY (targetNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_E66938283F47F8B0 ON IVRCustomEntries (targetNumberCountryId)');
        $this->addSql('UPDATE IVRCustomEntries SET targetNumberCountryId = (SELECT errorNumberCountryId FROM IVRCustom WHERE IVRCustom.id = IVRCustomEntries.IVRCustomId)');

        $this->addSql('ALTER TABLE Queues ADD timeoutNumberCountryId INT UNSIGNED DEFAULT NULL AFTER timeoutTargetType');
        $this->addSql('ALTER TABLE Queues ADD fullNumberCountryId INT UNSIGNED DEFAULT NULL AFTER fullTargetType');
        $this->addSql('ALTER TABLE Queues ADD CONSTRAINT FK_C86607A0892C2FA FOREIGN KEY (timeoutNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Queues ADD CONSTRAINT FK_C86607A0F1C3650E FOREIGN KEY (fullNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_C86607A0892C2FA ON Queues (timeoutNumberCountryId)');
        $this->addSql('CREATE INDEX IDX_C86607A0F1C3650E ON Queues (fullNumberCountryId)');
        $this->addSql('UPDATE Queues SET timeoutNumberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = Queues.companyId)  WHERE timeoutNumberValue IS NOT NULL');
        $this->addSql('UPDATE Queues SET fullNumberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = Queues.companyId)  WHERE fullNumberValue IS NOT NULL');

        $this->addSql('ALTER TABLE FaxesInOut ADD dstCountryId INT UNSIGNED DEFAULT NULL AFTER src');
        $this->addSql('ALTER TABLE FaxesInOut ADD CONSTRAINT FK_E047541D57B9B0B1 FOREIGN KEY (dstCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_E047541D57B9B0B1 ON FaxesInOut (dstCountryId)');
        $this->addSql('UPDATE FaxesInOut SET dstCountryId = (SELECT countryId FROM Companies INNER JOIN Faxes ON Faxes.companyId = Companies.id WHERE Faxes.id = FaxesInOut.faxId) WHERE type = "Out" AND dst IS NOT NULL');

        $this->addSql('ALTER TABLE HuntGroups ADD noAnswerNumberCountryId INT UNSIGNED DEFAULT NULL AFTER noAnswerTargetType');
        $this->addSql('ALTER TABLE HuntGroups ADD CONSTRAINT FK_4F9672ECD7819488 FOREIGN KEY (noAnswerNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_4F9672ECFFB4E15B ON HuntGroups (noAnswerNumberCountryId)');
        $this->addSql('UPDATE HuntGroups SET noAnswerNumberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = HuntGroups.companyId)  WHERE noAnswerNumberValue IS NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE IVRCommon DROP FOREIGN KEY FK_E0B977E9892C2FA');
        $this->addSql('ALTER TABLE IVRCommon DROP FOREIGN KEY FK_E0B977E9AEABB8D3');
        $this->addSql('DROP INDEX IDX_E0B977E9892C2FA ON IVRCommon');
        $this->addSql('DROP INDEX IDX_E0B977E9AEABB8D3 ON IVRCommon');
        $this->addSql('ALTER TABLE IVRCommon DROP timeoutNumberCountryId, DROP errorNumberCountryId');

        $this->addSql('ALTER TABLE IVRCustom DROP FOREIGN KEY FK_F0D11123892C2FA');
        $this->addSql('ALTER TABLE IVRCustom DROP FOREIGN KEY FK_F0D11123AEABB8D3');
        $this->addSql('DROP INDEX IDX_F0D11123892C2FA ON IVRCustom');
        $this->addSql('DROP INDEX IDX_F0D11123AEABB8D3 ON IVRCustom');
        $this->addSql('ALTER TABLE IVRCustom DROP timeoutNumberCountryId, DROP errorNumberCountryId');

        $this->addSql('ALTER TABLE IVRCustomEntries DROP FOREIGN KEY FK_E66938283F47F8B0');
        $this->addSql('DROP INDEX IDX_E66938283F47F8B0 ON IVRCustomEntries');
        $this->addSql('ALTER TABLE IVRCustomEntries DROP targetNumberCountryId');

        $this->addSql('ALTER TABLE Extensions DROP FOREIGN KEY FK_9AAD9F79D7819488');
        $this->addSql('DROP INDEX IDX_9AAD9F79D7819488 ON Extensions');
        $this->addSql('ALTER TABLE Extensions DROP numberCountryId');

        $this->addSql('ALTER TABLE ConditionalRoutes DROP FOREIGN KEY FK_AFB65F0DD7819488');
        $this->addSql('DROP INDEX IDX_AFB65F0DD7819488 ON ConditionalRoutes');
        $this->addSql('ALTER TABLE ConditionalRoutes DROP numberCountryId');

        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP FOREIGN KEY FK_425473C9D7819488');
        $this->addSql('DROP INDEX IDX_425473C9D7819488 ON ConditionalRoutesConditions');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP numberCountryId');

        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY FK_528CEED9A7D09CD9');
        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY FK_528CEED9AEC84907');
        $this->addSql('DROP INDEX IDX_528CEED9A7D09CD9 ON ExternalCallFilters');
        $this->addSql('DROP INDEX IDX_528CEED9AEC84907 ON ExternalCallFilters');
        $this->addSql('ALTER TABLE ExternalCallFilters DROP holidayNumberCountryId, DROP outOfScheduleNumberCountryId');

        $this->addSql('ALTER TABLE CallForwardSettings DROP FOREIGN KEY FK_E71B58A4D7819488');
        $this->addSql('DROP INDEX IDX_E71B58A4D7819488 ON CallForwardSettings');
        $this->addSql('ALTER TABLE CallForwardSettings DROP numberCountryId');

        $this->addSql('ALTER TABLE Queues DROP FOREIGN KEY FK_C86607A0892C2FA');
        $this->addSql('ALTER TABLE Queues DROP FOREIGN KEY FK_C86607A0F1C3650E');
        $this->addSql('DROP INDEX IDX_C86607A0892C2FA ON Queues');
        $this->addSql('DROP INDEX IDX_C86607A0F1C3650E ON Queues');
        $this->addSql('ALTER TABLE Queues DROP timeoutNumberCountryId, DROP fullNumberCountryId');

        $this->addSql('ALTER TABLE FaxesInOut DROP FOREIGN KEY FK_E047541D57B9B0B1');
        $this->addSql('DROP INDEX IDX_E047541D57B9B0B1 ON FaxesInOut');
        $this->addSql('ALTER TABLE FaxesInOut DROP dstCountryId');

        $this->addSql('ALTER TABLE HuntGroups DROP FOREIGN KEY FK_4F9672ECD7819488');
        $this->addSql('DROP INDEX IDX_4F9672ECFFB4E15B ON HuntGroups');
        $this->addSql('ALTER TABLE HuntGroups DROP numberCountryId');

    }
}
