<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190423104815 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends ADD t38Passthrough VARCHAR(255) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no]\'');
        $this->addSql('ALTER TABLE Terminals ADD t38Passthrough VARCHAR(255) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no]\'');
        $this->addSql('ALTER TABLE RetailAccounts ADD t38Passthrough VARCHAR(255) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no]\'');
        $this->addSql('ALTER TABLE ResidentialDevices ADD t38Passthrough VARCHAR(255) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no]\'');
        $this->addSql('ALTER TABLE ast_ps_endpoints ADD t38_udptl VARCHAR(255) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no]\', ADD t38_udptl_ec VARCHAR(255) DEFAULT \'none\' NOT NULL COMMENT \'[enum:none|fec|redundancy]\', ADD t38_udptl_maxdatagram INT UNSIGNED DEFAULT 0 NOT NULL, ADD t38_udptl_nat VARCHAR(255) DEFAULT \'yes\' NOT NULL COMMENT \'[enum:yes|no]\'');

        $this->addSql('DROP VIEW `kam_users`');
        $this->addSql('CREATE VIEW `kam_users` AS
                            SELECT E.type, E.name, D.domain, E.password, E.companyId, E.id AS objectId, E.extension,
                                E.externalIpCalls, E.maxCalls, CONCAT(T.id,0) AS caller_in, CONCAT(T.id,1) AS callee_in,
                                CONCAT(T.id,2) AS caller_out, CONCAT(T.id,3) AS callee_out, E.t38Passthrough
                            FROM (
                                SELECT "terminal" as type, T.name, T.domainId, T.password, T.companyId,
                                    U.transformationRuleSetId, U.id, E.number AS extension, U.externalIpCalls, U.maxCalls, T.t38Passthrough
                                    FROM Terminals T
                                        INNER JOIN Users U ON U.terminalId = T.id
                                        INNER JOIN Extensions E ON E.id=U.extensionId
                                UNION
                                    SELECT "friend" AS type, name, domainId, password, companyId, transformationRuleSetId,
                                    id, NULL AS extension, NULL AS externalIpCalls, 0 AS maxCalls, t38Passthrough
                                        FROM Friends
                                UNION
                                    SELECT "residential" AS type, name, domainId, password, companyId, transformationRuleSetId,
                                    id, NULL AS extension, NULL AS externalIpCalls, RD.maxCalls, RD.t38Passthrough
                                        FROM ResidentialDevices RD
                                UNION
                                    SELECT "retail" AS type, name, domainId, password, companyId, transformationRuleSetId,
                                    id, NULL AS extension, NULL AS externalIpCalls, 0 AS maxCalls, RA.t38Passthrough
                                        FROM RetailAccounts RA
                            ) AS E
                            INNER JOIN Companies C ON C.id = E.companyId
                            INNER JOIN TransformationRuleSets T ON T.id = COALESCE(E.transformationRuleSetId, C.transformationRuleSetId)
                            INNER JOIN Domains D ON D.id = E.domainId');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends DROP t38Passthrough');
        $this->addSql('ALTER TABLE ResidentialDevices DROP t38Passthrough');
        $this->addSql('ALTER TABLE RetailAccounts DROP t38Passthrough');
        $this->addSql('ALTER TABLE Terminals DROP t38Passthrough');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP t38_udptl, DROP t38_udptl_ec, DROP t38_udptl_maxdatagram, DROP t38_udptl_nat');

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
                                    id, NULL AS extension, NULL AS externalIpCalls, RD.maxCalls
                                        FROM ResidentialDevices RD
                                UNION
                                    SELECT "retail" AS type, name, domainId, password, companyId, transformationRuleSetId,
                                    id, NULL AS extension, NULL AS externalIpCalls, 0 AS maxCalls
                                        FROM RetailAccounts RA
                            ) AS E
                            INNER JOIN Companies C ON C.id = E.companyId
                            INNER JOIN TransformationRuleSets T ON T.id = COALESCE(E.transformationRuleSetId, C.transformationRuleSetId)
                            INNER JOIN Domains D ON D.id = E.domainId');
    }
}
