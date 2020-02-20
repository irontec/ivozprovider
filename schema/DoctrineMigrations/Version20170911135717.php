<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170911135717 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns DROP FOREIGN KEY PricingPlansRelTargetPatterns_ibfk_1');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns DROP FOREIGN KEY PricingPlansRelTargetPatterns_ibfk_2');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT FK_CAD1B6B5EDF37044 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT FK_CAD1B6B54D2CFC16 FOREIGN KEY (targetPatternId) REFERENCES TargetPatterns (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Languages DROP name');
        $this->addSql('ALTER TABLE RoutingPatterns DROP name, DROP description');
        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY ExternalCallFilters_ibfk_3');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT FK_528CEED99FB29831 FOREIGN KEY (holidayLocutionId) REFERENCES Locutions (id)');
        $this->addSql('ALTER TABLE GenericMusicOnHold DROP FOREIGN KEY fGenericMusicOnHold_ibfk_1');
        $this->addSql('ALTER TABLE GenericMusicOnHold ADD CONSTRAINT FK_F9FA93559CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlans DROP name, DROP description');
        $this->addSql('ALTER TABLE TargetPatterns DROP name, DROP description');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP FOREIGN KEY ConditionalRoutesConditions_ibfk_5');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD CONSTRAINT FK_425473C9AF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY Companies_ibfk_11');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B52899C8555117 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Companies RENAME INDEX outgoingddiruleid TO IDX_B52899FC6BB9C8');
        $this->addSql('ALTER TABLE ConditionalRoutes DROP FOREIGN KEY ConditionalRoutes_ibfk_5');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD CONSTRAINT FK_AFB65F0DAF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ConferenceRooms CHANGE maxMembers maxMembers SMALLINT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Extensions DROP FOREIGN KEY Extensions_ibfk_5');
        $this->addSql('ALTER TABLE Extensions ADD CONSTRAINT FK_9AAD9F7923E42D0D FOREIGN KEY (conferenceRoomId) REFERENCES ConferenceRooms (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Extensions RENAME INDEX conditionalrouteid TO IDX_9AAD9F799E2CE667');
        $this->addSql('ALTER TABLE Timezones DROP FOREIGN KEY Timezones_ibfk_2');
        $this->addSql('ALTER TABLE Timezones DROP timeZoneLabel');
        $this->addSql('ALTER TABLE Timezones ADD CONSTRAINT FK_F7A34AFDFBA2A6B4 FOREIGN KEY (countryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE BrandURLs DROP FOREIGN KEY BrandURLs_ibfk_1');
        $this->addSql('ALTER TABLE BrandURLs ADD CONSTRAINT FK_8DBE74F59CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE OutgoingRouting CHANGE priority priority SMALLINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE IVRCustomEntries RENAME INDEX IVRCustomEntries_ibfk_5 TO IDX_E6693828F1B1189');
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY DDIs_ibfk_11');
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY DDIs_ibfk_9');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT FK_AA16E1A023E42D0D FOREIGN KEY (conferenceRoomId) REFERENCES ConferenceRooms (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT FK_AA16E1A0FBA2A6B4 FOREIGN KEY (countryId) REFERENCES Countries (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE DDIs RENAME INDEX conditionalrouteid TO IDX_AA16E1A09E2CE667');
        $this->addSql('ALTER TABLE DDIs RENAME INDEX faxes_ibfk_8 TO peeringContractId');
        $this->addSql('ALTER TABLE DDIs RENAME INDEX faxes_ibfk_9 TO countryId');
        $this->addSql('ALTER TABLE DDIs RENAME INDEX ddis_ibfk_10 TO brandId');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies DROP FOREIGN KEY PricingPlansRelCompanies_ibfk_1');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies DROP FOREIGN KEY PricingPlansRelCompanies_ibfk_2');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT FK_78F195D2EDF37044 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT FK_78F195D22480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Users CHANGE maxCalls maxCalls INT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Users RENAME INDEX outgoingddiruleid TO IDX_D5428AEDFC6BB9C8');
        $this->addSql('ALTER TABLE Users RENAME INDEX voicemaillocutionid TO IDX_D5428AEDF32B4B65');
        $this->addSql('ALTER TABLE Users RENAME INDEX bossassistantwhitelistid TO IDX_D5428AED6FA2F8E7');
        $this->addSql('ALTER TABLE Features DROP name');
        $this->addSql('ALTER TABLE Domains DROP FOREIGN KEY Domains_ibfk_1');
        $this->addSql('ALTER TABLE Domains DROP FOREIGN KEY Domains_ibfk_2');
        $this->addSql('ALTER TABLE Domains ADD CONSTRAINT FK_43C686012480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Domains ADD CONSTRAINT FK_43C686019CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE MatchListPatterns RENAME INDEX matchlistpatterns_ibfk_2 TO MatchListPatternId');
        $this->addSql('ALTER TABLE Countries DROP name, DROP zone');
        $this->addSql('ALTER TABLE Services DROP name, DROP description');
        $this->addSql('ALTER TABLE ast_ps_endpoints RENAME INDEX retailaccountid TO IDX_800B60515EA9D64D');
        $this->addSql('ALTER TABLE kam_users_address DROP FOREIGN KEY kam_users_address_ibfk_1');
        $this->addSql('ALTER TABLE kam_users_address ADD CONSTRAINT FK_A53CBBF22480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_rtpproxy DROP FOREIGN KEY kam_rtpproxy_ibfk_1');
        $this->addSql('ALTER TABLE kam_rtpproxy ADD CONSTRAINT FK_729D1741C8555117 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_users_domain_attrs DROP FOREIGN KEY kam_users_domain_attrs_ibfk_1');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BrandURLs DROP FOREIGN KEY FK_8DBE74F59CBEC244');
        $this->addSql('ALTER TABLE BrandURLs ADD CONSTRAINT BrandURLs_ibfk_1 FOREIGN KEY (brandId) REFERENCES Brands (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899C8555117');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT Companies_ibfk_11 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Companies RENAME INDEX IDX_B52899FC6BB9C8 TO outgoingDDIRuleId');
        $this->addSql('ALTER TABLE ConditionalRoutes DROP FOREIGN KEY FK_AFB65F0DAF230FFD');
        $this->addSql('ALTER TABLE ConditionalRoutes ADD CONSTRAINT ConditionalRoutes_ibfk_5 FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions DROP FOREIGN KEY FK_425473C9AF230FFD');
        $this->addSql('ALTER TABLE ConditionalRoutesConditions ADD CONSTRAINT ConditionalRoutesConditions_ibfk_5 FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ConferenceRooms CHANGE maxMembers maxMembers TINYINT(3) UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Countries ADD name VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci COMMENT \'[ml]\', ADD zone VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci COMMENT \'[ml]\'');
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY FK_AA16E1A023E42D0D');
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY FK_AA16E1A0FBA2A6B4');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT DDIs_ibfk_11 FOREIGN KEY (conferenceRoomId) REFERENCES ConferenceRooms (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT DDIs_ibfk_9 FOREIGN KEY (countryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE DDIs RENAME INDEX peeringcontractid TO Faxes_ibfk_8');
        $this->addSql('ALTER TABLE DDIs RENAME INDEX countryid TO Faxes_ibfk_9');
        $this->addSql('ALTER TABLE DDIs RENAME INDEX brandid TO DDIs_ibfk_10');
        $this->addSql('ALTER TABLE DDIs RENAME INDEX idx_aa16e1a09e2ce667 TO conditionalRouteId');
        $this->addSql('ALTER TABLE Domains DROP FOREIGN KEY FK_43C686012480E723');
        $this->addSql('ALTER TABLE Domains DROP FOREIGN KEY FK_43C686019CBEC244');
        $this->addSql('ALTER TABLE Domains ADD CONSTRAINT Domains_ibfk_1 FOREIGN KEY (companyId) REFERENCES Companies (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Domains ADD CONSTRAINT Domains_ibfk_2 FOREIGN KEY (brandId) REFERENCES Brands (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Extensions DROP FOREIGN KEY FK_9AAD9F7923E42D0D');
        $this->addSql('ALTER TABLE Extensions ADD CONSTRAINT Extensions_ibfk_5 FOREIGN KEY (conferenceRoomId) REFERENCES ConferenceRooms (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Extensions RENAME INDEX idx_9aad9f799e2ce667 TO conditionalRouteId');
        $this->addSql('ALTER TABLE ExternalCallFilters DROP FOREIGN KEY FK_528CEED99FB29831');
        $this->addSql('ALTER TABLE ExternalCallFilters ADD CONSTRAINT ExternalCallFilters_ibfk_3 FOREIGN KEY (holidayLocutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Features ADD name VARCHAR(50) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\'');
        $this->addSql('ALTER TABLE GenericMusicOnHold DROP FOREIGN KEY FK_F9FA93559CBEC244');
        $this->addSql('ALTER TABLE GenericMusicOnHold ADD CONSTRAINT fGenericMusicOnHold_ibfk_1 FOREIGN KEY (brandId) REFERENCES Brands (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVRCustomEntries RENAME INDEX idx_e6693828f1b1189 TO targetConditionalRouteId');
        $this->addSql('ALTER TABLE Languages ADD name VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\'');
        $this->addSql('ALTER TABLE MatchListPatterns RENAME INDEX matchlistpatternid TO MatchListPatterns_ibfk_2');
        $this->addSql('ALTER TABLE OutgoingRouting CHANGE priority priority TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE PricingPlans ADD name VARCHAR(55) NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\', ADD description VARCHAR(55) NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\'');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies DROP FOREIGN KEY FK_78F195D2EDF37044');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies DROP FOREIGN KEY FK_78F195D22480E723');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT PricingPlansRelCompanies_ibfk_1 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT PricingPlansRelCompanies_ibfk_2 FOREIGN KEY (companyId) REFERENCES Companies (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns DROP FOREIGN KEY FK_CAD1B6B5EDF37044');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns DROP FOREIGN KEY FK_CAD1B6B54D2CFC16');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT PricingPlansRelTargetPatterns_ibfk_1 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT PricingPlansRelTargetPatterns_ibfk_2 FOREIGN KEY (targetPatternId) REFERENCES TargetPatterns (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RoutingPatterns ADD name VARCHAR(55) NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\', ADD description VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci COMMENT \'[ml]\'');
        $this->addSql('ALTER TABLE Services ADD name VARCHAR(50) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\', ADD description VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\'');
        $this->addSql('ALTER TABLE TargetPatterns ADD name VARCHAR(55) NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\', ADD description VARCHAR(55) NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\'');
        $this->addSql('ALTER TABLE Timezones DROP FOREIGN KEY FK_F7A34AFDFBA2A6B4');
        $this->addSql('ALTER TABLE Timezones ADD timeZoneLabel VARCHAR(20) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci COMMENT \'[ml]\'');
        $this->addSql('ALTER TABLE Timezones ADD CONSTRAINT Timezones_ibfk_2 FOREIGN KEY (countryId) REFERENCES Countries (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Users CHANGE maxCalls maxCalls SMALLINT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Users RENAME INDEX IDX_D5428AEDFC6BB9C8 TO outgoingDDIRuleId');
        $this->addSql('ALTER TABLE Users RENAME INDEX idx_d5428aedf32b4b65 TO voicemailLocutionId');
        $this->addSql('ALTER TABLE Users RENAME INDEX IDX_D5428AED6FA2F8E7 TO bossassistantwhitelistid');
        $this->addSql('ALTER TABLE ast_ps_endpoints RENAME INDEX idx_800b60515ea9d64d TO retailAccountId');
        $this->addSql('ALTER TABLE kam_rtpproxy DROP FOREIGN KEY FK_729D1741C8555117');
        $this->addSql('ALTER TABLE kam_rtpproxy ADD CONSTRAINT kam_rtpproxy_ibfk_1 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_users_address DROP FOREIGN KEY FK_A53CBBF22480E723');
        $this->addSql('ALTER TABLE kam_users_address ADD CONSTRAINT kam_users_address_ibfk_1 FOREIGN KEY (companyId) REFERENCES Companies (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_users_domain_attrs ADD CONSTRAINT kam_users_domain_attrs_ibfk_1 FOREIGN KEY (did) REFERENCES Domains (domain) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
