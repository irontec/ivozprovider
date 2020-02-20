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

        $this->addSql('DROP TABLE ast_ps_aors');
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
        $this->addSql('CREATE TABLE ast_ps_aors (sorcery_id VARCHAR(40) NOT NULL, default_expiration INT DEFAULT NULL, max_contacts INT DEFAULT NULL, minimum_expiration INT DEFAULT NULL, remove_existing VARCHAR(255) DEFAULT NULL, authenticate_qualify VARCHAR(255) DEFAULT NULL, maximum_expiration INT DEFAULT NULL, support_path VARCHAR(255) DEFAULT NULL, contact VARCHAR(200) DEFAULT NULL, qualify_frequency INT DEFAULT NULL, psEndpoint INT UNSIGNED NOT NULL, INDEX IDX_96365EB84FBA0BA (psEndpoint), INDEX sorcery_idx (sorcery_id), INDEX contact_idx (contact), PRIMARY KEY(sorcery_id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ast_ps_aors ADD CONSTRAINT FK_96365EB84FBA0BA FOREIGN KEY (psEndpoint) REFERENCES ast_ps_endpoints (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO ast_ps_aors (sorcery_id, contact, psEndpoint) SELECT CONCAT("b", C.brandId, "c", C.id, "t", T.id, "_", T.name), CONCAT("sip:", T.name, "@", C.domain_users), APE.id  FROM Terminals T INNER JOIN Companies C ON C.id = T.companyId INNER JOIN ast_ps_endpoints APE ON APE.terminalId = T.id');
        $this->addSql('INSERT INTO ast_ps_aors (sorcery_id, contact, psEndpoint) SELECT CONCAT("b", C.brandId, "c", C.id, "r", R.id, "_", R.name), CONCAT("sip:", R.name, "@", C.domain_users), APE.id  FROM RetailAccounts R INNER JOIN Companies C ON C.id = R.companyId INNER JOIN ast_ps_endpoints APE ON APE.retailAccountId = R.id');
        $this->addSql('INSERT INTO ast_ps_aors (sorcery_id, contact, psEndpoint) SELECT CONCAT("b", C.brandId, "c", C.id, "f", F.id, "_", F.name), CONCAT("sip:", F.name, "@", C.domain_users), APE.id  FROM Friends F INNER JOIN Companies C ON C.id = F.companyId INNER JOIN ast_ps_endpoints APE ON APE.friendId = F.id');


    }
}
