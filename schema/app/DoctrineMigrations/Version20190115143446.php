<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190115143446 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ast_ps_endpoints ADD retailAccountId INT UNSIGNED DEFAULT NULL AFTER residentialDeviceId');
        $this->addSql('ALTER TABLE ast_ps_endpoints ADD CONSTRAINT FK_800B60515EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_800B60515EA9D64D ON ast_ps_endpoints (retailAccountId)');

        $this->addSql('DROP VIEW IF EXISTS ast_ps_aors');
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
                    UNION
                        SELECT "rt" AS type, id, name, domainId, companyId
                        FROM RetailAccounts
                    ) AS E
                    INNER JOIN Companies C ON C.id = E.companyId
                    INNER JOIN Domains D ON D.id = E.domainId'
        );

        $this->addSql('INSERT INTO ast_ps_endpoints (
                            sorcery_id,
                            aors,
                            from_domain,
                            retailAccountId,
                            context
                    ) SELECT
                            CONCAT("b", C.brandId, "c", C.id, "rt", RA.id, "_", RA.name),
                            CONCAT("b", C.brandId, "c", C.id, "rt", RA.id, "_", RA.name),
                            D.domain,
                            RA.id,
                            "retail"
                    FROM RetailAccounts RA
                    INNER JOIN Companies C ON C.id = RA.companyId
                    INNER JOIN Domains D ON D.id = C.domainId'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM ast_ps_endpoints WHERE retailAccountId IS NOT NULL');

        $this->addSql('ALTER TABLE ast_ps_endpoints DROP FOREIGN KEY FK_800B60515EA9D64D');
        $this->addSql('DROP INDEX IDX_800B60515EA9D64D ON ast_ps_endpoints');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP retailAccountId');

        $this->addSql('DROP VIEW IF EXISTS ast_ps_aors');
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
                    UNION
                        SELECT "rt" AS type, id, name, domainId, companyId
                        FROM RetailAccounts
                    ) AS E
                    INNER JOIN Companies C ON C.id = E.companyId
                    INNER JOIN Domains D ON D.id = E.domainId'
        );
    }
}
