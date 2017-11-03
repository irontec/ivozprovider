<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171031181245 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands ADD domainId INT UNSIGNED DEFAULT NULL AFTER name');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E4102334600F3 FOREIGN KEY (domainId) REFERENCES Domains (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_790E4102334600F3 ON Brands (domainId)');

        $this->addSql('ALTER TABLE Companies ADD domainId INT UNSIGNED DEFAULT NULL AFTER name');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B52899334600F3 FOREIGN KEY (domainId) REFERENCES Domains (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B52899334600F3 ON Companies (domainId)');


        $this->addSql('ALTER TABLE Friends ADD domainId INT UNSIGNED DEFAULT NULL AFTER name, DROP domain');
        $this->addSql('ALTER TABLE Friends ADD CONSTRAINT FK_EE5349F5334600F3 FOREIGN KEY (domainId) REFERENCES Domains (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_EE5349F5334600F3 ON Friends (domainId)');
        $this->addSql('CREATE UNIQUE INDEX name_domain ON Friends (name, domainId)');

        $this->addSql('DROP INDEX name_domain ON Terminals');
        $this->addSql('ALTER TABLE Terminals ADD domainId INT UNSIGNED DEFAULT NULL AFTER name, DROP domain');
        $this->addSql('ALTER TABLE Terminals ADD CONSTRAINT FK_98AB47BB334600F3 FOREIGN KEY (domainId) REFERENCES Domains (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_98AB47BB334600F3 ON Terminals (domainId)');
        $this->addSql('CREATE UNIQUE INDEX name_domain ON Terminals (name, domainId)');

        $this->addSql('ALTER TABLE RetailAccounts ADD domainId INT UNSIGNED DEFAULT NULL AFTER name, DROP domain');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D9250334600F3 FOREIGN KEY (domainId) REFERENCES Domains (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_732D9250334600F3 ON RetailAccounts (domainId)');

        $this->addSql('UPDATE Companies SET domainId = (SELECT id FROM Domains WHERE companyId = Companies.id)');
        $this->addSql('UPDATE Brands SET domainId = (SELECT id FROM Domains WHERE brandId = Brands.id)');
        $this->addSql('UPDATE Terminals SET domainId = (SELECT id FROM Domains WHERE companyId = Terminals.companyId)');
        $this->addSql('UPDATE Friends SET domainId = (SELECT id FROM Domains WHERE companyId = Friends.companyId)');
        $this->addSql('UPDATE RetailAccounts SET domainId = (SELECT id FROM Domains WHERE brandId = RetailAccounts.brandId)');

        $this->addSql('ALTER TABLE Domains DROP FOREIGN KEY FK_43C686012480E723');
        $this->addSql('ALTER TABLE Domains DROP FOREIGN KEY FK_43C686019CBEC244');
        $this->addSql('DROP INDEX one_domain_per_brand ON Domains');
        $this->addSql('DROP INDEX one_domain_per_company ON Domains');
        $this->addSql('DROP INDEX brandId ON Domains');
        $this->addSql('DROP INDEX companyId ON Domains');
        $this->addSql('ALTER TABLE Domains DROP scope, DROP brandId, DROP companyId');

        $this->addSql('DROP VIEW kam_users');
        $this->addSql('CREATE VIEW kam_users AS SELECT E.type, E.name, D.domain, E.password, E.companyId, CONCAT(T.id,0) AS caller_in, CONCAT(T.id,1) AS callee_in, CONCAT(T.id,2) AS caller_out, CONCAT(T.id,3) AS callee_out FROM (SELECT "terminal" as type, T.name, T.domainId, T.password, T.companyId, U.transformationRuleSetId FROM Terminals T INNER JOIN Users U ON U.terminalId = T.id UNION SELECT "friend" AS type, name, domainId, password, companyId, transformationRuleSetId FROM Friends UNION SELECT "retail" AS type, name, domainId, password, companyId, transformationRuleSetId FROM RetailAccounts) AS E INNER JOIN Companies C ON C.id = E.companyId INNER JOIN TransformationRuleSets T ON T.id = COALESCE(E.transformationRuleSetId, C.transformationRuleSetId) INNER JOIN Domains D ON D.id = E.domainId');

        $this->addSql('DROP TABLE ast_ps_aors');
        $this->addSql('CREATE VIEW ast_ps_aors AS SELECT CONCAT("b", C.brandId, "c", C.id, E.type, E.id, "_", E.name) AS sorcery_id, CONCAT("sip:", E.name, "@", D.domain) AS contact FROM (SELECT "t" AS type, T.id, T.name, T.domainId, T.companyId FROM Terminals T INNER JOIN Users U ON U.terminalId = T.id UNION SELECT "f" AS type, id, name, domainId, companyId FROM Friends UNION SELECT "r" AS type, id, name, domainId, companyId FROM RetailAccounts) AS E INNER JOIN Companies C ON C.id = E.companyId INNER JOIN Domains D ON D.id = E.domainId');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Domains ADD scope VARCHAR(255) DEFAULT \'global\' NOT NULL, ADD brandId INT UNSIGNED DEFAULT NULL, ADD companyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Domains ADD CONSTRAINT FK_43C686012480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Domains ADD CONSTRAINT FK_43C686019CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX one_domain_per_brand ON Domains (pointsTo, brandId)');
        $this->addSql('CREATE UNIQUE INDEX one_domain_per_company ON Domains (pointsTo, companyId)');
        $this->addSql('CREATE INDEX brandId ON Domains (brandId)');
        $this->addSql('CREATE INDEX companyId ON Domains (companyId)');
        $this->addSql('UPDATE Domains SET companyId = (SELECT id FROM Companies WHERE domain_users = Domains.domain)');
        $this->addSql('UPDATE Domains SET brandId = (SELECT id FROM Brands WHERE domain_users = Domains.domain)');

        $this->addSql('ALTER TABLE Friends DROP FOREIGN KEY FK_EE5349F5334600F3');
        $this->addSql('DROP INDEX IDX_EE5349F5334600F3 ON Friends');
        $this->addSql('DROP INDEX name_domain ON Friends');
        $this->addSql('ALTER TABLE Friends ADD domain VARCHAR(190) DEFAULT NULL AFTER name, DROP domainId');
        $this->addSql('ALTER TABLE RetailAccounts DROP FOREIGN KEY FK_732D9250334600F3');
        $this->addSql('DROP INDEX IDX_732D9250334600F3 ON RetailAccounts');
        $this->addSql('ALTER TABLE RetailAccounts ADD domain VARCHAR(190) DEFAULT NULL AFTER name, DROP domainId');
        $this->addSql('ALTER TABLE Terminals DROP FOREIGN KEY FK_98AB47BB334600F3');
        $this->addSql('DROP INDEX IDX_98AB47BB334600F3 ON Terminals');
        $this->addSql('DROP INDEX name_domain ON Terminals');
        $this->addSql('ALTER TABLE Terminals ADD domain VARCHAR(190) DEFAULT NULL AFTER name, DROP domainId');
        $this->addSql('CREATE UNIQUE INDEX name_domain ON Terminals (name, domain)');

        $this->addSql('UPDATE Terminals SET domain = (SELECT domain FROM Domains WHERE companyId = Terminals.companyId)');
        $this->addSql('UPDATE Friends SET domain = (SELECT domain FROM Domains WHERE companyId = Friends.companyId)');
        $this->addSql('UPDATE RetailAccounts SET domain = (SELECT domain FROM Domains WHERE brandId = RetailAccounts.brandId)');

        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E4102334600F3');
        $this->addSql('DROP INDEX IDX_790E4102334600F3 ON Brands');
        $this->addSql('ALTER TABLE Brands DROP domainId');

        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899334600F3');
        $this->addSql('DROP INDEX IDX_B52899334600F3 ON Companies');
        $this->addSql('ALTER TABLE Companies DROP domainId');


        $this->addSql('DROP VIEW kam_users');
        $this->addSql('CREATE VIEW kam_users AS SELECT E.type, E.name, E.domain, E.password, E.companyId, CONCAT(T.id,0) AS caller_in, CONCAT(T.id,1) AS callee_in, CONCAT(T.id,2) AS caller_out, CONCAT(T.id,3) AS callee_out FROM (SELECT "terminal" as type, T.name, T.domain, T.password, T.companyId, U.transformationRuleSetId FROM Terminals T INNER JOIN Users U ON U.terminalId = T.id UNION SELECT "friend" AS type, name, domain, password, companyId, transformationRuleSetId FROM Friends UNION SELECT "retail" AS type, name, domain, password, companyId, transformationRuleSetId FROM RetailAccounts) AS E INNER JOIN Companies C ON C.id = E.companyId INNER JOIN TransformationRuleSets T ON T.id = COALESCE(E.transformationRuleSetId, C.transformationRuleSetId)');

        $this->addSql('DROP VIEW ast_ps_aors');
        $this->addSql('CREATE TABLE ast_ps_aors (sorcery_id VARCHAR(40) NOT NULL, default_expiration INT DEFAULT NULL, max_contacts INT DEFAULT NULL, minimum_expiration INT DEFAULT NULL, remove_existing VARCHAR(255) DEFAULT NULL, authenticate_qualify VARCHAR(255) DEFAULT NULL, maximum_expiration INT DEFAULT NULL, support_path VARCHAR(255) DEFAULT NULL, contact VARCHAR(200) DEFAULT NULL, qualify_frequency INT DEFAULT NULL, psEndpoint INT UNSIGNED NOT NULL, INDEX IDX_96365EB84FBA0BA (psEndpoint), INDEX sorcery_idx (sorcery_id), INDEX contact_idx (contact), PRIMARY KEY(sorcery_id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ast_ps_aors ADD CONSTRAINT FK_96365EB84FBA0BA FOREIGN KEY (psEndpoint) REFERENCES ast_ps_endpoints (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO ast_ps_aors (sorcery_id, contact, psEndpoint) SELECT CONCAT("b", C.brandId, "c", C.id, "t", T.id, "_", T.name), CONCAT("sip:", T.name, "@", C.domain_users), APE.id  FROM Terminals T INNER JOIN Companies C ON C.id = T.companyId INNER JOIN ast_ps_endpoints APE ON APE.terminalId = T.id');
        $this->addSql('INSERT INTO ast_ps_aors (sorcery_id, contact, psEndpoint) SELECT CONCAT("b", C.brandId, "c", C.id, "r", R.id, "_", R.name), CONCAT("sip:", R.name, "@", C.domain_users), APE.id  FROM RetailAccounts R INNER JOIN Companies C ON C.id = R.companyId INNER JOIN ast_ps_endpoints APE ON APE.retailAccountId = R.id');
        $this->addSql('INSERT INTO ast_ps_aors (sorcery_id, contact, psEndpoint) SELECT CONCAT("b", C.brandId, "c", C.id, "f", F.id, "_", F.name), CONCAT("sip:", F.name, "@", C.domain_users), APE.id  FROM Friends F INNER JOIN Companies C ON C.id = F.companyId INNER JOIN ast_ps_endpoints APE ON APE.friendId = F.id');
    }
}
