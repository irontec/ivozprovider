<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200710151403 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP VIEW `kam_users`');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
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
}
