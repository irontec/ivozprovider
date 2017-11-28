<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171128092838 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ParsedCDRs');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ParsedCDRs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, statId INT UNSIGNED DEFAULT NULL, xstatId INT UNSIGNED DEFAULT NULL, statType VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, initialLeg VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, initialLegHash VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, cid VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, cidHash VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, xcid VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, xcidHash VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, proxies VARCHAR(32) DEFAULT NULL COLLATE utf8_general_ci, type VARCHAR(32) DEFAULT NULL COLLATE utf8_general_ci, subtype VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, calldate DATETIME DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL COMMENT \'(DC2Type:datetime)\', duration INT UNSIGNED DEFAULT NULL, aParty VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, bParty VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, caller VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, callee VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, xCaller VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, xCallee VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, initialReferrer VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, referrer VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, referee VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, lastForwarder VARCHAR(32) DEFAULT NULL COLLATE utf8_general_ci, brandId INT UNSIGNED DEFAULT NULL, companyId INT UNSIGNED DEFAULT NULL, peeringContractId INT UNSIGNED DEFAULT NULL, UNIQUE INDEX cid (cid), INDEX brandId (brandId), INDEX companyId (companyId), INDEX peeringContractId (peeringContractId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ParsedCDRs ADD CONSTRAINT FK_A94BA5792480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ParsedCDRs ADD CONSTRAINT FK_A94BA5797DB780F8 FOREIGN KEY (peeringContractId) REFERENCES PeeringContracts (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ParsedCDRs ADD CONSTRAINT FK_A94BA5799CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
    }
}
