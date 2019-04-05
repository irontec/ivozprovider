<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180621134613 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY DDIs_ibfk_14');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP FOREIGN KEY ast_ps_endpoints_ibfk_3');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP FOREIGN KEY FK_238F735B5EA9D64D');
        $this->addSql('CREATE TABLE ResidentialDevices (
                              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                              brandId INT UNSIGNED NOT NULL,
                              companyId INT UNSIGNED NOT NULL,
                              name VARCHAR(65) NOT NULL,
                              domainId INT UNSIGNED DEFAULT NULL,
                              description VARCHAR(500) DEFAULT \'\' NOT NULL,
                              transport VARCHAR(25) NOT NULL COMMENT \'[enum:udp|tcp|tls]\',
                              ip VARCHAR(50) DEFAULT NULL,
                              port SMALLINT UNSIGNED DEFAULT NULL,
                              auth_needed VARCHAR(255) DEFAULT \'yes\' NOT NULL,
                              password VARCHAR(64) DEFAULT NULL,
                              outgoingDdiId INT UNSIGNED DEFAULT NULL,
                              disallow VARCHAR(200) DEFAULT \'all\' NOT NULL,
                              allow VARCHAR(200) DEFAULT \'alaw\' NOT NULL,
                              direct_media_method VARCHAR(255) DEFAULT \'update\' NOT NULL COMMENT \'[enum:invite|update]\',
                              callerid_update_header VARCHAR(255) DEFAULT \'pai\' NOT NULL COMMENT \'[enum:pai|rpid]\',
                              update_callerid VARCHAR(255) DEFAULT \'yes\' NOT NULL COMMENT \'[enum:yes|no]\',
                              from_domain VARCHAR(190) DEFAULT NULL,
                              directConnectivity VARCHAR(255) DEFAULT \'yes\' NOT NULL COMMENT \'[enum:yes|no]\',
                              languageId INT UNSIGNED DEFAULT NULL,
                              transformationRuleSetId INT UNSIGNED DEFAULT NULL,
                          INDEX IDX_1805369A9CBEC244 (brandId),
                          INDEX IDX_1805369A334600F3 (domainId),
                          INDEX IDX_1805369A2480E723 (companyId),
                          INDEX IDX_1805369A2FECF701 (transformationRuleSetId),
                          INDEX IDX_1805369A508D43B5 (outgoingDdiId),
                          INDEX IDX_1805369A940D8C7E (languageId),
                          UNIQUE INDEX residentialDevice_name_brand (name, brandId),
                          PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        $this->addSql('ALTER TABLE ResidentialDevices ADD CONSTRAINT FK_1805369A9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ResidentialDevices ADD CONSTRAINT FK_1805369A334600F3 FOREIGN KEY (domainId) REFERENCES Domains (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ResidentialDevices ADD CONSTRAINT FK_1805369A2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ResidentialDevices ADD CONSTRAINT FK_1805369A2FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ResidentialDevices ADD CONSTRAINT FK_1805369A508D43B5 FOREIGN KEY (outgoingDdiId) REFERENCES DDIs (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ResidentialDevices ADD CONSTRAINT FK_1805369A940D8C7E FOREIGN KEY (languageId) REFERENCES Languages (id) ON DELETE SET NULL');
        $this->addSql('INSERT INTO ResidentialDevices SELECT * FROM RetailAccounts');

        // Check if delta 081-retailaccount-cfw.sql is already applied
        $delta81Applied = $this->connection->query('SELECT 1 FROM changelog WHERE change_number = 81')->rowCount();
        if ($delta81Applied) {
            $this->addSql('ALTER TABLE CallForwardSettings DROP FOREIGN KEY CallForwardSettings_ibfk_4');
            $this->addSql('DROP INDEX retailAccountId ON CallForwardSettings');
            $this->addSql('ALTER TABLE CallForwardSettings CHANGE retailaccountid residentialDeviceId INT UNSIGNED DEFAULT NULL');
            $this->connection->query('DELETE FROM changelog WHERE change_number = 81')->execute();
        } else {
            $this->addSql('ALTER TABLE CallForwardSettings ADD residentialDeviceId INT UNSIGNED DEFAULT NULL');
        }

        $this->addSql('ALTER TABLE CallForwardSettings ADD CONSTRAINT FK_E71B58A48B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_E71B58A48B329DCD ON CallForwardSettings (residentialDeviceId)');

        // Check if delta 082-retailaccount-voicemail.sql is already applied
        $delta82Applied = $this->connection->query('SELECT 1 FROM changelog WHERE change_number = 82')->rowCount();
        if ($delta82Applied) {
            $this->addSql('ALTER TABLE ast_voicemail DROP FOREIGN KEY ast_voicemail_ibfk_2');
            $this->addSql('DROP INDEX retailAccountId ON ast_voicemail');
            $this->addSql('ALTER TABLE ast_voicemail CHANGE retailaccountid residentialDeviceId INT UNSIGNED DEFAULT NULL');
            $this->connection->query('DELETE FROM changelog WHERE change_number = 82')->execute();
        } else {
            $this->addSql('ALTER TABLE ast_voicemail ADD residentialDeviceId INT UNSIGNED DEFAULT NULL');
        }

        $this->addSql('ALTER TABLE ast_voicemail ADD CONSTRAINT FK_B2AD1D0A8B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_B2AD1D0A8B329DCD ON ast_voicemail (residentialDeviceId)');

        $this->addSql('DROP TABLE RetailAccounts');
        $this->addSql('ALTER TABLE Companies CHANGE type type VARCHAR(25) DEFAULT \'vpbx\' NOT NULL COMMENT \'[enum:vpbx|retail|wholesale|residential]\'');
        $this->addSql('UPDATE Companies SET type = "residential" WHERE type = "retail"');
        $this->addSql('ALTER TABLE Extensions CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|ivr|huntGroup|conferenceRoom|friend|queue|conditional]\'');
        $this->addSql('DROP INDEX IDX_AA16E1A05EA9D64D ON DDIs');
        $this->addSql('ALTER TABLE DDIs CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|conditional|residential]\', CHANGE retailaccountid residentialDeviceId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT FK_AA16E1A08B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AA16E1A08B329DCD ON DDIs (residentialDeviceId)');
        $this->addSql('UPDATE DDIs SET routeType = "residential" WHERE routeType = "retailAccount"');
        $this->addSql('DROP INDEX IDX_800B60515EA9D64D ON ast_ps_endpoints');
        $this->addSql('ALTER TABLE ast_ps_endpoints CHANGE retailaccountid residentialDeviceId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ast_ps_endpoints ADD CONSTRAINT FK_800B60518B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON DELETE CASCADE');
        $this->addSql('UPDATE ast_ps_endpoints SET context = "residential" WHERE context = "retail"');
        $this->addSql('CREATE INDEX IDX_800B60518B329DCD ON ast_ps_endpoints (residentialDeviceId)');
        $this->addSql('DROP INDEX usersCdr_retailAccountId ON kam_users_cdrs');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE kam_users_cdrs CHANGE retailaccountid residentialDeviceId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B8B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX usersCdr_residentialDeviceId ON kam_users_cdrs (residentialDeviceId)');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');

        $this->addSql('UPDATE Features SET iden = "residential", name_en = "Residential Clients", name_es = "Clientes Residencial" WHERE id = 9');

        $this->addSql('DROP VIEW `kam_users`');
        $this->addSql('CREATE VIEW `kam_users` AS
                            SELECT E.type, E.name, D.domain, E.password, E.companyId, E.id AS objectId, E.extension,
                                E.externalIpCalls, E.maxCalls, CONCAT(T.id,0) AS caller_in, CONCAT(T.id,1) AS callee_in,
                                CONCAT(T.id,2) AS caller_out, CONCAT(T.id,3) AS callee_out
                            FROM (
                                SELECT "terminal" as type, T.name, T.domainId, T.password, T.companyId,
                                    U.transformationRuleSetId, U.id, E.number AS extension, U.externalIpCalls, U.maxCalls
                                    FROM Terminals T
                                        INNER JOIN Users U ON U.terminalId = T.id
                                        INNER JOIN Extensions E ON E.id=U.extensionId
                                UNION
                                    SELECT "friend" AS type, name, domainId, password, companyId, transformationRuleSetId,
                                    id, NULL AS extension, NULL AS externalIpCalls, 0 AS maxCalls
                                        FROM Friends
                                UNION
                                    SELECT "residential" AS type, name, domainId, password, companyId, transformationRuleSetId,
                                    id, NULL AS extension, NULL AS externalIpCalls, 0 AS maxCalls
                                        FROM ResidentialDevices
                            ) AS E
                            INNER JOIN Companies C ON C.id = E.companyId
                            INNER JOIN TransformationRuleSets T ON T.id = COALESCE(E.transformationRuleSetId, C.transformationRuleSetId)
                            INNER JOIN Domains D ON D.id = E.domainId');

        $this->addSql('DROP VIEW ast_ps_aors');
        $this->addSql('CREATE VIEW ast_ps_aors AS
                            SELECT CONCAT("b", C.brandId, "c", C.id, E.type, E.id, "_", E.name)
                                AS sorcery_id, CONCAT("sip:", E.name, "@", D.domain) AS contact, 0 as qualify_frequency
                            FROM (
                                SELECT "t" AS type, T.id, T.name, T.domainId, T.companyId FROM
                                    Terminals T UNION SELECT "f" AS type, id, name, domainId, companyId
                                FROM Friends
                            UNION
                                SELECT "r" AS type, id, name, domainId, companyId
                                FROM ResidentialDevices
                            ) AS E
                            INNER JOIN Companies C ON C.id = E.companyId
                            INNER JOIN Domains D ON D.id = E.domainId');



    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY FK_AA16E1A08B329DCD');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP FOREIGN KEY FK_800B60518B329DCD');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP FOREIGN KEY FK_238F735B8B329DCD');
        $this->addSql('ALTER TABLE ast_voicemail DROP FOREIGN KEY FK_B2AD1D0A8B329DCD');
        $this->addSql('ALTER TABLE CallForwardSettings DROP FOREIGN KEY FK_E71B58A48B329DCD');
        $this->addSql('CREATE TABLE RetailAccounts (id INT UNSIGNED AUTO_INCREMENT NOT NULL, brandId INT UNSIGNED NOT NULL, companyId INT UNSIGNED NOT NULL, name VARCHAR(65) NOT NULL COLLATE utf8_general_ci, domainId INT UNSIGNED DEFAULT NULL, description VARCHAR(500) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, transport VARCHAR(25) NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:udp|tcp|tls]\', ip VARCHAR(50) DEFAULT NULL COLLATE utf8_general_ci, port SMALLINT UNSIGNED DEFAULT NULL, auth_needed VARCHAR(255) DEFAULT \'yes\' NOT NULL COLLATE utf8_general_ci, password VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, outgoingDDIId INT UNSIGNED DEFAULT NULL, disallow VARCHAR(200) DEFAULT \'all\' NOT NULL COLLATE utf8_general_ci, allow VARCHAR(200) DEFAULT \'alaw\' NOT NULL COLLATE utf8_general_ci, direct_media_method VARCHAR(255) DEFAULT \'update\' NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:invite|update]\', callerid_update_header VARCHAR(255) DEFAULT \'pai\' NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:pai|rpid]\', update_callerid VARCHAR(255) DEFAULT \'yes\' NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:yes|no]\', from_domain VARCHAR(190) DEFAULT NULL COLLATE utf8_general_ci, directConnectivity VARCHAR(255) DEFAULT \'yes\' NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:yes|no]\', languageId INT UNSIGNED DEFAULT NULL, transformationRuleSetId INT UNSIGNED DEFAULT NULL, UNIQUE INDEX retailAccount_name_brand (name, brandId), INDEX IDX_732D92509CBEC244 (brandId), INDEX IDX_732D92502480E723 (companyId), INDEX IDX_732D9250508D43B5 (outgoingDDIId), INDEX IDX_732D9250940D8C7E (languageId), INDEX IDX_732D92502FECF701 (transformationRuleSetId), INDEX IDX_732D9250334600F3 (domainId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO RetailAccounts SELECT * FROM ResidentialDevices');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D92502FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D9250334600F3 FOREIGN KEY (domainId) REFERENCES Domains (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT RetailAccounts_ibfk_1 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT RetailAccounts_ibfk_2 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT RetailAccounts_ibfk_4 FOREIGN KEY (outgoingDDIId) REFERENCES DDIs (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT RetailAccounts_ibfk_5 FOREIGN KEY (languageId) REFERENCES Languages (id) ON DELETE SET NULL');
        $this->addSql('DROP TABLE ResidentialDevices');
        $this->addSql('ALTER TABLE Companies CHANGE type type VARCHAR(25) DEFAULT \'vpbx\' NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:vpbx|retail|wholesale]\'');
        $this->addSql('DROP INDEX IDX_E71B58A48B329DCD ON CallForwardSettings');
        $this->addSql('DROP INDEX IDX_AA16E1A08B329DCD ON DDIs');
        $this->addSql('DROP INDEX IDX_B2AD1D0A8B329DCD ON ast_voicemail');
        $this->addSql('ALTER TABLE DDIs CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COLLATE utf8_general_ci COMMENT \'[enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|retailAccount|conditional]\', CHANGE residentialdeviceid retailAccountId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT DDIs_ibfk_14 FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AA16E1A05EA9D64D ON DDIs (retailAccountId)');
        $this->addSql('ALTER TABLE Extensions CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COLLATE utf8_general_ci COMMENT \'[enum:user|number|ivr|huntGroup|conferenceRoom|friend|queue|retailAccount|conditional]\'');
        $this->addSql('DROP INDEX IDX_800B60518B329DCD ON ast_ps_endpoints');
        $this->addSql('ALTER TABLE ast_ps_endpoints CHANGE residentialdeviceid retailAccountId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ast_ps_endpoints ADD CONSTRAINT ast_ps_endpoints_ibfk_3 FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_800B60515EA9D64D ON ast_ps_endpoints (retailAccountId)');
        $this->addSql('DROP INDEX usersCdr_residentialDeviceId ON kam_users_cdrs');
        $this->addSql('ALTER TABLE kam_users_cdrs CHANGE residentialdeviceid retailAccountId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B5EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX usersCdr_retailAccountId ON kam_users_cdrs (retailAccountId)');
        $this->addSql('ALTER TABLE ast_voicemail DROP residentialDeviceId');
        $this->addSql('ALTER TABLE CallForwardSettings DROP residentialDeviceId');


        $this->addSql('DROP VIEW kam_users');
        $this->addSql('CREATE VIEW `kam_users` AS SELECT E.type, E.name, D.domain, E.password, E.companyId, E.id AS objectId, E.extension, E.externalIpCalls, E.maxCalls, CONCAT(T.id,0) AS caller_in, CONCAT(T.id,1) AS callee_in, CONCAT(T.id,2) AS caller_out, CONCAT(T.id,3) AS callee_out FROM (SELECT "terminal" as type, T.name, T.domainId, T.password, T.companyId, U.transformationRuleSetId, U.id, E.number AS extension, U.externalIpCalls, U.maxCalls FROM Terminals T INNER JOIN Users U ON U.terminalId = T.id INNER JOIN Extensions E ON E.id=U.extensionId UNION SELECT "friend" AS type, name, domainId, password, companyId, transformationRuleSetId, id, NULL AS extension, NULL AS externalIpCalls, 0 AS maxCalls FROM Friends UNION SELECT "retail" AS type, name, domainId, password, companyId, transformationRuleSetId, id, NULL AS extension, NULL AS externalIpCalls, 0 AS maxCalls FROM RetailAccounts) AS E INNER JOIN Companies C ON C.id = E.companyId INNER JOIN TransformationRuleSets T ON T.id = COALESCE(E.transformationRuleSetId, C.transformationRuleSetId) INNER JOIN Domains D ON D.id = E.domainId');
        $this->addSql('DROP VIEW ast_ps_aors');
        $this->addSql('CREATE VIEW ast_ps_aors AS SELECT CONCAT("b", C.brandId, "c", C.id, E.type, E.id, "_", E.name) AS sorcery_id, CONCAT("sip:", E.name, "@", D.domain) AS contact, 0 as qualify_frequency FROM (SELECT "t" AS type, T.id, T.name, T.domainId, T.companyId FROM Terminals T UNION SELECT "f" AS type, id, name, domainId, companyId FROM Friends UNION SELECT "r" AS type, id, name, domainId, companyId FROM RetailAccounts) AS E INNER JOIN Companies C ON C.id = E.companyId INNER JOIN Domains D ON D.id = E.domainId');
    }
}
