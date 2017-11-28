<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171128152948 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP VIEW ast_ps_aors');
        $this->addSql('CREATE VIEW ast_ps_aors AS SELECT CONCAT("b", C.brandId, "c", C.id, E.type, E.id, "_", E.name) AS sorcery_id, CONCAT("sip:", E.name, "@", D.domain) AS contact, 0 as qualify_frequency FROM (SELECT "t" AS type, T.id, T.name, T.domainId, T.companyId FROM Terminals T UNION SELECT "f" AS type, id, name, domainId, companyId FROM Friends UNION SELECT "r" AS type, id, name, domainId, companyId FROM RetailAccounts) AS E INNER JOIN Companies C ON C.id = E.companyId INNER JOIN Domains D ON D.id = E.domainId');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP VIEW ast_ps_aors');
        $this->addSql('CREATE VIEW ast_ps_aors AS SELECT CONCAT("b", C.brandId, "c", C.id, E.type, E.id, "_", E.name) AS sorcery_id, CONCAT("sip:", E.name, "@", D.domain) AS contact FROM (SELECT "t" AS type, T.id, T.name, T.domainId, T.companyId FROM Terminals T UNION SELECT "f" AS type, id, name, domainId, companyId FROM Friends UNION SELECT "r" AS type, id, name, domainId, companyId FROM RetailAccounts) AS E INNER JOIN Companies C ON C.id = E.companyId INNER JOIN Domains D ON D.id = E.domainId');

    }
}
