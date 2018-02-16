<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171127124756 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ConditionalRoutes DROP FOREIGN KEY ConditionalRoutes_ibfk_2');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP FOREIGN KEY ConditionalRoutesConditions_ibfk_2');
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY DDIs_ibfk_4');
        $this->addSql('ALTER TABLE Extensions DROP FOREIGN KEY Extensions_ibfk_2');
        $this->addSql('ALTER TABLE ConditionalRoutes DROP FOREIGN KEY ConditionalRoutes_ibfk_3');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP FOREIGN KEY ConditionalRoutesConditions_ibfk_3');
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY DDIs_ibfk_5');
        $this->addSql('ALTER TABLE Extensions DROP FOREIGN KEY Extensions_ibfk_3');
        $this->addSql('ALTER TABLE IVRCustomEntries DROP FOREIGN KEY IVRCustomEntries_ibfk_1');

        $this->addSql('CREATE TABLE IVRs (
                        id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                        companyId INT UNSIGNED NOT NULL,
                        name VARCHAR(50) NOT NULL,
                        timeout SMALLINT UNSIGNED NOT NULL,
                        maxDigits SMALLINT UNSIGNED NOT NULL,
                        welcomeLocutionId INT UNSIGNED DEFAULT NULL,                                        
                        successLocutionId INT UNSIGNED DEFAULT NULL,                                        
                        allowExtensions TINYINT(1) UNSIGNED DEFAULT \'0\' NOT NULL,
                        noInputLocutionId INT UNSIGNED DEFAULT NULL,
                        noInputRouteType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:number|extension|voicemail]\',
                        noInputNumberCountryId INT UNSIGNED DEFAULT NULL,                                        
                        noInputNumberValue VARCHAR(25) DEFAULT NULL,
                        noInputExtensionId INT UNSIGNED DEFAULT NULL,
                        noInputVoiceMailUserId INT UNSIGNED DEFAULT NULL,
                        errorLocutionId INT UNSIGNED DEFAULT NULL,
                        errorRouteType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:number|extension|voicemail]\',
                        errorNumberCountryId INT UNSIGNED DEFAULT NULL, 
                        errorNumberValue VARCHAR(25) DEFAULT NULL,
                        errorExtensionId INT UNSIGNED DEFAULT NULL,
                        errorVoiceMailUserId INT UNSIGNED DEFAULT NULL,
                        INDEX IDX_EEE885F92ECAF600 (welcomeLocutionId),
                        INDEX IDX_EEE885F976587A80 (successLocutionId),
                        INDEX IDX_EEE885F9563D5224 (noInputLocutionId),
                        INDEX IDX_EEE885F9E59A53FA (noInputExtensionId),
                        INDEX IDX_EEE885F99ED32186 (noInputVoiceMailUserId),
                        INDEX IDX_EEE885F9E671BAF3 (noInputNumberCountryId),
                        INDEX IDX_EEE885F922DAA5F5 (errorLocutionId),
                        INDEX IDX_EEE885F9143A564F (errorExtensionId),
                        INDEX IDX_EEE885F9D60923A6 (errorVoiceMailUserId),
                        INDEX IDX_EEE885F9AEABB8D3 (errorNumberCountryId),
                        INDEX companyId (companyId),
                        UNIQUE INDEX nameCompany (name, companyId),
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        $this->addSql('CREATE TABLE IVRExcludedExtensions (
                        id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                        ivrId INT UNSIGNED NOT NULL,
                        extensionId INT UNSIGNED NOT NULL,
                        INDEX ivrId (ivrId),
                        INDEX extensionId (extensionId),
                        UNIQUE INDEX uniqueExtension (ivrId, extensionId),
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        $this->addSql('CREATE TABLE IVREntries (
                        id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                        ivrId INT UNSIGNED NOT NULL,
                        entry VARCHAR(40) NOT NULL,
                        welcomeLocutionId INT UNSIGNED DEFAULT NULL,
                        routeType VARCHAR(25) NOT NULL COMMENT \'[enum:number|extension|voicemail|conditional]\',
                        numberCountryId INT UNSIGNED DEFAULT NULL,
                        numberValue VARCHAR(25) DEFAULT NULL,
                        extensionId INT UNSIGNED DEFAULT NULL,
                        voiceMailUserId INT UNSIGNED DEFAULT NULL,
                        conditionalRouteId INT UNSIGNED DEFAULT NULL,
                        INDEX IDX_E847DD7C2ECAF600 (welcomeLocutionId),
                        INDEX IDX_E847DD7C12AB7F65 (extensionId),
                        INDEX IDX_E847DD7CAF230FFD (voiceMailUserId),
                        INDEX IDX_E847DD7C9E2CE667 (conditionalRouteId),
                        INDEX IDX_E847DD7CD7819488 (numberCountryId),
                        INDEX ivrId (ivrId),
                        UNIQUE INDEX UniqueIVRCutomIdAndEntry (ivrId, entry),
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F92480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F92ECAF600 FOREIGN KEY (welcomeLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F9563D5224 FOREIGN KEY (noInputLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F922DAA5F5 FOREIGN KEY (errorLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F976587A80 FOREIGN KEY (successLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F9E59A53FA FOREIGN KEY (noInputExtensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F9143A564F FOREIGN KEY (errorExtensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F99ED32186 FOREIGN KEY (noInputVoiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F9D60923A6 FOREIGN KEY (errorVoiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F9E671BAF3 FOREIGN KEY (noInputNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRs ADD CONSTRAINT FK_EEE885F9AEABB8D3 FOREIGN KEY (errorNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRExcludedExtensions ADD CONSTRAINT FK_36E264F22045F052 FOREIGN KEY (ivrId) REFERENCES IVRs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVRExcludedExtensions ADD CONSTRAINT FK_36E264F212AB7F65 FOREIGN KEY (extensionId) REFERENCES Extensions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7C2045F052 FOREIGN KEY (ivrId) REFERENCES IVRs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7C2ECAF600 FOREIGN KEY (welcomeLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7C12AB7F65 FOREIGN KEY (extensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7CAF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7C9E2CE667 FOREIGN KEY (conditionalRouteId) REFERENCES ConditionalRoutes (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7CD7819488 FOREIGN KEY (numberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');

        // Migration Time!
        $this->addSql('ALTER TABLE IVRs ADD ivrCommonId INT UNSIGNED, ADD ivrCustomId INT UNSIGNED');
        $this->addSql('INSERT INTO IVRs (
                            ivrCommonId, name, companyId, timeout, maxDigits,
                            welcomeLocutionId, successLocutionId, allowExtensions,
                            noInputLocutionId, noInputRouteType, noInputNumberCountryId, noInputNumberValue, noInputExtensionId, noInputVoiceMailUserId,
                            errorLocutionId, errorRouteType, errorNumberCountryId, errorNumberValue, errorExtensionId, errorVoiceMailUserId
                        ) SELECT id, CONCAT(name, " (common)"), companyId, timeout, maxDigits,
                            welcomeLocutionId, successLocutionId, "1",
                            noAnswerLocutionId, timeoutTargetType, timeoutNumberCountryId, timeoutNumberValue, timeoutExtensionId, timeoutVoiceMailUserId,
                            errorLocutionId, errorTargetType, errorNumberCountryId, errorNumberValue, errorExtensionId, errorVoiceMailUserId
                        FROM IVRCommon');

        $this->addSql('INSERT INTO IVRs (
                            ivrCustomId, name, companyId, timeout, maxDigits,
                            welcomeLocutionId, successLocutionId, allowExtensions,
                            noInputLocutionId, noInputRouteType, noInputNumberCountryId, noInputNumberValue, noInputExtensionId, noInputVoiceMailUserId,
                            errorLocutionId, errorRouteType, errorNumberCountryId, errorNumberValue, errorExtensionId, errorVoiceMailUserId
                        ) SELECT id, CONCAT(name, " (custom)"), companyId, timeout, maxDigits,
                            welcomeLocutionId, successLocutionId, "0",
                            noAnswerLocutionId, timeoutTargetType, timeoutNumberCountryId, timeoutNumberValue, timeoutExtensionId, timeoutVoiceMailUserId,
                            errorLocutionId, errorTargetType, errorNumberCountryId, errorNumberValue, errorExtensionId, errorVoiceMailUserId
                        FROM IVRCustom');

        $this->addSql('INSERT INTO IVREntries (
                            ivrId, entry, welcomeLocutionId,
                            routeType, numberCountryId, numberValue, extensionId, voiceMailUserId, conditionalRouteId
                        ) SELECT IVRs.id, IVRCustomEntries.entry, IVRCustomEntries.welcomeLocutionId,
                            targetType, targetNumberCountryId, targetNumberValue, targetExtensionId, targetVoiceMailUserId, targetConditionalRouteId
                        FROM IVRCustomEntries INNER JOIN IVRs ON IVRs.ivrCustomId = IVRCustomEntries.IVRCustomId');
                            
        $this->addSql('DROP TABLE IVRCommon');
        $this->addSql('DROP TABLE IVRCustom');
        $this->addSql('DROP TABLE IVRCustomEntries');


        $this->addSql('DROP INDEX IVRCommonId ON ConditionalRoutesConditions');
        $this->addSql('DROP INDEX IVRCustomId ON ConditionalRoutesConditions');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD ivrId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|ivr|huntGroup|voicemail|friend|queue|conferenceRoom|extension]\'');
        $this->addSql('UPDATE ConditionalRoutesConditions INNER JOIN IVRs ON ConditionalRoutesConditions.IVRCommonId = IVRs.ivrCommonId SET routeType = "ivr", ivrId = IVRs.id WHERE routeType = "IVRCommon"');
        $this->addSql('UPDATE ConditionalRoutesConditions INNER JOIN IVRs ON ConditionalRoutesConditions.IVRCustomId = IVRs.ivrCustomId SET routeType = "ivr", ivrId = IVRs.id WHERE routeType = "IVRCustom"');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP IVRCommonId, DROP IVRCustomId');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD CONSTRAINT FK_425473C92045F052 FOREIGN KEY (ivrId) REFERENCES IVRs (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_425473C92045F052 ON ConditionalRoutesConditions (ivrId)');

        $this->addSql('DROP INDEX IVRCommonId ON ConditionalRoutes');
        $this->addSql('DROP INDEX IVRCustomId ON ConditionalRoutes');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD ivrId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|ivr|huntGroup|voicemail|friend|queue|conferenceRoom|extension]\'');
        $this->addSql('UPDATE ConditionalRoutes INNER JOIN IVRs ON ConditionalRoutes.IVRCommonId = IVRs.ivrCommonId SET routeType = "ivr", ivrId = IVRs.id WHERE routeType = "IVRCommon"');
        $this->addSql('UPDATE ConditionalRoutes INNER JOIN IVRs ON ConditionalRoutes.IVRCustomId = IVRs.ivrCustomId SET routeType = "ivr", ivrId = IVRs.id WHERE routeType = "IVRCustom"');
        $this->addSql('ALTER TABLE ConditionalRoutes DROP IVRCommonId, DROP IVRCustomId');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD CONSTRAINT FK_AFB65F0D2045F052 FOREIGN KEY (ivrId) REFERENCES IVRs (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AFB65F0D2045F052 ON ConditionalRoutes (ivrId)');

        $this->addSql('DROP INDEX IVRCommonId ON Extensions');
        $this->addSql('DROP INDEX IVRCustomId ON Extensions');
        $this->addSql('ALTER TABLE Extensions ADD ivrId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|ivr|huntGroup|conferenceRoom|friend|queue|retailAccount|conditional]\'');
        $this->addSql('UPDATE Extensions INNER JOIN IVRs ON Extensions.IVRCommonId = IVRs.ivrCommonId SET routeType = "ivr", ivrId = IVRs.id WHERE routeType = "IVRCommon"');
        $this->addSql('UPDATE Extensions INNER JOIN IVRs ON Extensions.IVRCustomId = IVRs.ivrCustomId SET routeType = "ivr", ivrId = IVRs.id WHERE routeType = "IVRCustom"');
        $this->addSql('ALTER TABLE Extensions DROP IVRCommonId, DROP IVRCustomId');
        $this->addSql('ALTER TABLE Extensions ADD CONSTRAINT FK_9AAD9F792045F052 FOREIGN KEY (ivrId) REFERENCES IVRs (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_9AAD9F792045F052 ON Extensions (ivrId)');


        $this->addSql('DROP INDEX IVRCommonId ON DDIs');
        $this->addSql('DROP INDEX IVRCustomId ON DDIs');
        $this->addSql('ALTER TABLE DDIs ADD ivrId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|retailAccount|conditional]\'');
        $this->addSql('UPDATE DDIs INNER JOIN IVRs ON DDIs.IVRCommonId = IVRs.ivrCommonId SET routeType = "ivr", ivrId = IVRs.id WHERE routeType = "IVRCommon"');
        $this->addSql('UPDATE DDIs INNER JOIN IVRs ON DDIs.IVRCustomId = IVRs.ivrCustomId SET routeType = "ivr", ivrId = IVRs.id WHERE routeType = "IVRCustom"');
        $this->addSql('ALTER TABLE DDIs DROP IVRCommonId, DROP IVRCustomId');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT FK_AA16E1A02045F052 FOREIGN KEY (ivrId) REFERENCES IVRs (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AA16E1A02045F052 ON DDIs (ivrId)');

        $this->addSql('ALTER TABLE IVRs DROP ivrCommonId, DROP ivrCustomId');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP FOREIGN KEY FK_425473C92045F052');
        $this->addSql('ALTER TABLE ConditionalRoutes DROP FOREIGN KEY FK_AFB65F0D2045F052');
        $this->addSql('ALTER TABLE Extensions DROP FOREIGN KEY FK_9AAD9F792045F052');
        $this->addSql('ALTER TABLE IVRExcludedExtensions DROP FOREIGN KEY FK_36E264F22045F052');
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY FK_AA16E1A02045F052');
        $this->addSql('ALTER TABLE IVREntries DROP FOREIGN KEY FK_E847DD7C2045F052');
        $this->addSql('CREATE TABLE IVRCommon (id INT UNSIGNED AUTO_INCREMENT NOT NULL, companyId INT UNSIGNED NOT NULL, name VARCHAR(50) NOT NULL, blackListRegExp VARCHAR(255) DEFAULT NULL, welcomeLocutionId INT UNSIGNED DEFAULT NULL, noAnswerLocutionId INT UNSIGNED DEFAULT NULL, errorLocutionId INT UNSIGNED DEFAULT NULL, successLocutionId INT UNSIGNED DEFAULT NULL, timeout SMALLINT UNSIGNED NOT NULL, maxDigits SMALLINT UNSIGNED NOT NULL, noAnswerTimeout INT DEFAULT 10, timeoutTargetType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:number|extension|voicemail]\', timeoutNumberCountryId INT UNSIGNED DEFAULT NULL, timeoutNumberValue VARCHAR(25) DEFAULT NULL, timeoutExtensionId INT UNSIGNED DEFAULT NULL, timeoutVoiceMailUserId INT UNSIGNED DEFAULT NULL, errorTargetType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:number|extension|voicemail]\', errorNumberCountryId INT UNSIGNED DEFAULT NULL, errorNumberValue VARCHAR(25) DEFAULT NULL, errorExtensionId INT UNSIGNED DEFAULT NULL, errorVoiceMailUserId INT UNSIGNED DEFAULT NULL, UNIQUE INDEX nameCompany (name, companyId), INDEX companyId (companyId), INDEX welcomeLocutionId (welcomeLocutionId), INDEX noAnswerLocutionId (noAnswerLocutionId), INDEX errorLocutionId (errorLocutionId), INDEX successLocutionId (successLocutionId), INDEX noAnswerExtensionId (timeoutExtensionId), INDEX errorExtensionId (errorExtensionId), INDEX noAnswerVoiceMailUserId (timeoutVoiceMailUserId), INDEX errorVoiceMailUserId (errorVoiceMailUserId), INDEX IDX_E0B977E9892C2FA (timeoutNumberCountryId), INDEX IDX_E0B977E9AEABB8D3 (errorNumberCountryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IVRCustom (id INT UNSIGNED AUTO_INCREMENT NOT NULL, companyId INT UNSIGNED NOT NULL, name VARCHAR(50) NOT NULL, welcomeLocutionId INT UNSIGNED DEFAULT NULL, noAnswerLocutionId INT UNSIGNED DEFAULT NULL, errorLocutionId INT UNSIGNED DEFAULT NULL, successLocutionId INT UNSIGNED DEFAULT NULL, timeout SMALLINT UNSIGNED NOT NULL, maxDigits SMALLINT UNSIGNED NOT NULL, noAnswerTimeout INT DEFAULT 10, timeoutTargetType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:number|extension|voicemail]\', timeoutNumberCountryId INT UNSIGNED DEFAULT NULL, timeoutNumberValue VARCHAR(25) DEFAULT NULL, timeoutExtensionId INT UNSIGNED DEFAULT NULL, timeoutVoiceMailUserId INT UNSIGNED DEFAULT NULL, errorTargetType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:number|extension|voicemail]\', errorNumberCountryId INT UNSIGNED DEFAULT NULL, errorNumberValue VARCHAR(25) DEFAULT NULL, errorExtensionId INT UNSIGNED DEFAULT NULL, errorVoiceMailUserId INT UNSIGNED DEFAULT NULL, UNIQUE INDEX nameCompany (name, companyId), INDEX companyId (companyId), INDEX welcomeLocutionId (welcomeLocutionId), INDEX noAnswerLocutionId (noAnswerLocutionId), INDEX errorLocutionId (errorLocutionId), INDEX successLocutionId (successLocutionId), INDEX noAnswerExtensionId (timeoutExtensionId), INDEX errorExtensionId (errorExtensionId), INDEX noAnswerVoiceMailUserId (timeoutVoiceMailUserId), INDEX errorVoiceMailUserId (errorVoiceMailUserId), INDEX IDX_F0D11123892C2FA (timeoutNumberCountryId), INDEX IDX_F0D11123AEABB8D3 (errorNumberCountryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IVRCustomEntries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, IVRCustomId INT UNSIGNED NOT NULL, entry VARCHAR(40) NOT NULL, welcomeLocutionId INT UNSIGNED DEFAULT NULL, targetType VARCHAR(25) NOT NULL COMMENT \'[enum:number|extension|voicemail|conditional]\', targetNumberCountryId INT UNSIGNED DEFAULT NULL, targetNumberValue VARCHAR(25) DEFAULT NULL, targetExtensionId INT UNSIGNED DEFAULT NULL, targetVoiceMailUserId INT UNSIGNED DEFAULT NULL, targetConditionalRouteId INT UNSIGNED DEFAULT NULL, UNIQUE INDEX UniqueIVRCutomIdAndEntry (IVRCustomId, entry), INDEX IVRCustomId (IVRCustomId), INDEX welcomeLocutionId (welcomeLocutionId), INDEX targetExtensionId (targetExtensionId), INDEX targetVoiceMailUserId (targetVoiceMailUserId), INDEX IDX_E6693828F1B1189 (targetConditionalRouteId), INDEX IDX_E66938283F47F8B0 (targetNumberCountryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT FK_E0B977E9892C2FA FOREIGN KEY (timeoutNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT FK_E0B977E9AEABB8D3 FOREIGN KEY (errorNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT IVRCommon_ibfk_1 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT IVRCommon_ibfk_2 FOREIGN KEY (welcomeLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT IVRCommon_ibfk_3 FOREIGN KEY (noAnswerLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT IVRCommon_ibfk_4 FOREIGN KEY (errorLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT IVRCommon_ibfk_5 FOREIGN KEY (successLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT IVRCommon_ibfk_6 FOREIGN KEY (timeoutExtensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT IVRCommon_ibfk_7 FOREIGN KEY (errorExtensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT IVRCommon_ibfk_8 FOREIGN KEY (timeoutVoiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCommon ADD CONSTRAINT IVRCommon_ibfk_9 FOREIGN KEY (errorVoiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT FK_F0D11123892C2FA FOREIGN KEY (timeoutNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT FK_F0D11123AEABB8D3 FOREIGN KEY (errorNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT IVRCustom_ibfk_1 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT IVRCustom_ibfk_2 FOREIGN KEY (welcomeLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT IVRCustom_ibfk_3 FOREIGN KEY (noAnswerLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT IVRCustom_ibfk_4 FOREIGN KEY (errorLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT IVRCustom_ibfk_5 FOREIGN KEY (successLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT IVRCustom_ibfk_6 FOREIGN KEY (timeoutExtensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT IVRCustom_ibfk_7 FOREIGN KEY (errorExtensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT IVRCustom_ibfk_8 FOREIGN KEY (timeoutVoiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustom ADD CONSTRAINT IVRCustom_ibfk_9 FOREIGN KEY (errorVoiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustomEntries ADD CONSTRAINT FK_E66938283F47F8B0 FOREIGN KEY (targetNumberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustomEntries ADD CONSTRAINT IVRCustomEntries_ibfk_1 FOREIGN KEY (IVRCustomId) REFERENCES IVRCustom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVRCustomEntries ADD CONSTRAINT IVRCustomEntries_ibfk_2 FOREIGN KEY (welcomeLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustomEntries ADD CONSTRAINT IVRCustomEntries_ibfk_3 FOREIGN KEY (targetExtensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustomEntries ADD CONSTRAINT IVRCustomEntries_ibfk_4 FOREIGN KEY (targetVoiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVRCustomEntries ADD CONSTRAINT IVRCustomEntries_ibfk_5 FOREIGN KEY (targetConditionalRouteId) REFERENCES ConditionalRoutes (id) ON DELETE SET NULL');
        $this->addSql('DROP TABLE IVRs');
        $this->addSql('DROP TABLE IVRExcludedExtensions');
        $this->addSql('DROP TABLE IVREntries');
        $this->addSql('DROP INDEX IDX_AFB65F0D2045F052 ON ConditionalRoutes');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD IVRCustomId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|IVRCommon|IVRCustom|huntGroup|voicemail|friend|queue|conferenceRoom|extension]\', CHANGE ivrid IVRCommonId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD CONSTRAINT ConditionalRoutes_ibfk_2 FOREIGN KEY (IVRCommonId) REFERENCES IVRCommon (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD CONSTRAINT ConditionalRoutes_ibfk_3 FOREIGN KEY (IVRCustomId) REFERENCES IVRCustom (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IVRCommonId ON ConditionalRoutes (IVRCommonId)');
        $this->addSql('CREATE INDEX IVRCustomId ON ConditionalRoutes (IVRCustomId)');
        $this->addSql('DROP INDEX IDX_425473C92045F052 ON ConditionalRoutesConditions');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD IVRCustomId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|IVRCommon|IVRCustom|huntGroup|voicemail|friend|queue|conferenceRoom|extension]\', CHANGE ivrid IVRCommonId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD CONSTRAINT ConditionalRoutesConditions_ibfk_2 FOREIGN KEY (IVRCommonId) REFERENCES IVRCommon (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD CONSTRAINT ConditionalRoutesConditions_ibfk_3 FOREIGN KEY (IVRCustomId) REFERENCES IVRCustom (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IVRCommonId ON ConditionalRoutesConditions (IVRCommonId)');
        $this->addSql('CREATE INDEX IVRCustomId ON ConditionalRoutesConditions (IVRCustomId)');
        $this->addSql('DROP INDEX IDX_AA16E1A02045F052 ON DDIs');
        $this->addSql('ALTER TABLE DDIs ADD IVRCustomId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|IVRCommon|IVRCustom|huntGroup|fax|conferenceRoom|friend|queue|retailAccount|conditional]\', CHANGE ivrid IVRCommonId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT DDIs_ibfk_4 FOREIGN KEY (IVRCommonId) REFERENCES IVRCommon (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT DDIs_ibfk_5 FOREIGN KEY (IVRCustomId) REFERENCES IVRCustom (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IVRCommonId ON DDIs (IVRCommonId)');
        $this->addSql('CREATE INDEX IVRCustomId ON DDIs (IVRCustomId)');
        $this->addSql('DROP INDEX IDX_9AAD9F792045F052 ON Extensions');
        $this->addSql('ALTER TABLE Extensions ADD IVRCustomId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend|queue|retailAccount|conditional]\', CHANGE ivrid IVRCommonId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Extensions ADD CONSTRAINT Extensions_ibfk_2 FOREIGN KEY (IVRCommonId) REFERENCES IVRCommon (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Extensions ADD CONSTRAINT Extensions_ibfk_3 FOREIGN KEY (IVRCustomId) REFERENCES IVRCustom (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IVRCommonId ON Extensions (IVRCommonId)');
        $this->addSql('CREATE INDEX IVRCustomId ON Extensions (IVRCustomId)');
    }
}
