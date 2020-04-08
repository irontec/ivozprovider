<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180713123645 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE RetailAccounts (
                              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                              name VARCHAR(65) NOT NULL,
                              description VARCHAR(500) DEFAULT \'\' NOT NULL,
                              transport VARCHAR(25) NOT NULL COMMENT \'[enum:udp|tcp|tls]\',
                              ip VARCHAR(50) DEFAULT NULL,
                              port SMALLINT UNSIGNED DEFAULT NULL,
                              password VARCHAR(64) DEFAULT NULL,
                              fromDomain VARCHAR(190) DEFAULT NULL,
                              directConnectivity VARCHAR(255) DEFAULT \'yes\' NOT NULL COMMENT \'[enum:yes|no]\',
                              brandId INT UNSIGNED NOT NULL,
                              domainId INT UNSIGNED DEFAULT NULL,
                              companyId INT UNSIGNED NOT NULL,
                              transformationRuleSetId INT UNSIGNED DEFAULT NULL,
                              outgoingDdiId INT UNSIGNED DEFAULT NULL,
                          INDEX IDX_732D92509CBEC244 (brandId),
                          INDEX IDX_732D9250334600F3 (domainId),
                          INDEX IDX_732D92502480E723 (companyId),
                          INDEX IDX_732D92502FECF701 (transformationRuleSetId),
                          INDEX IDX_732D9250508D43B5 (outgoingDdiId),
                          UNIQUE INDEX retailAccount_name_brand (name, brandId),
                          PRIMARY KEY(id))
                          DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D92509CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D9250334600F3 FOREIGN KEY (domainId) REFERENCES Domains (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D92502480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D92502FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D9250508D43B5 FOREIGN KEY (outgoingDdiId) REFERENCES DDIs (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CallForwardSettings CHANGE userId userId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIs ADD retailAccountId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|conditional|residential|retail]\'');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT FK_AA16E1A05EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AA16E1A05EA9D64D ON DDIs (retailAccountId)');

        // Create a Brand feature to enable this client type
        $this->addSql('INSERT INTO Features (id, iden, name_en, name_es) VALUES (11, "retail", "Retail Clients", "Clientes Retail")');

        // Create kam_users with the new UAC type
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
                                    FROM Friends F
                            UNION
                                SELECT "residential" AS type, name, domainId, password, companyId, transformationRuleSetId,
                                id, NULL AS extension, NULL AS externalIpCalls, 0 AS maxCalls
                                    FROM ResidentialDevices RD
                            UNION
                                SELECT "retail" AS type, name, domainId, password, companyId, transformationRuleSetId,
                                id, NULL AS extension, NULL AS externalIpCalls, 0 AS maxCalls
                                    FROM RetailAccounts RA
                        ) AS E
                        INNER JOIN Companies C ON C.id = E.companyId
                        INNER JOIN TransformationRuleSets T ON T.id = COALESCE(E.transformationRuleSetId, C.transformationRuleSetId)
                        INNER JOIN Domains D ON D.id = E.domainId'
        );


        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD retailAccountId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B5EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_238F735B5EA9D64D ON kam_users_cdrs (retailAccountId)');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_users_cdrs DROP FOREIGN KEY FK_238F735B5EA9D64D');
        $this->addSql('DROP INDEX IDX_238F735B5EA9D64D ON kam_users_cdrs');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP retailAccountId');

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

        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY FK_AA16E1A05EA9D64D');
        $this->addSql('DROP TABLE RetailAccounts');
        $this->addSql('ALTER TABLE CallForwardSettings CHANGE userId userId INT UNSIGNED NOT NULL');
        $this->addSql('DROP INDEX IDX_AA16E1A05EA9D64D ON DDIs');
        $this->addSql('ALTER TABLE DDIs DROP retailAccountId, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COLLATE utf8_general_ci COMMENT \'[enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|conditional|residential]\'');
        $this->addSql('DELETE FROM Features WHERE id = 11');
    }
}
