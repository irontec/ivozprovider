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

    }
}
