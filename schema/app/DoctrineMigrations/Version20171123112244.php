<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171123112244 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX matchName ON MatchLists');
        $this->addSql('ALTER TABLE MatchLists ADD brandId INT UNSIGNED DEFAULT NULL AFTER id, CHANGE companyId companyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE MatchLists ADD CONSTRAINT FK_BAF072189CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX brandId ON MatchLists (brandId)');
        $this->addSql('CREATE UNIQUE INDEX listName ON MatchLists (brandId, companyId, name)');

        $this->addSql('ALTER TABLE CallACLRelPatterns DROP FOREIGN KEY CallACLRelPatterns_ibfk_2');
        $this->addSql('CREATE TABLE CallAclRelMatchLists (id INT UNSIGNED AUTO_INCREMENT NOT NULL, priority SMALLINT NOT NULL, policy VARCHAR(25) NOT NULL COMMENT \'[enum:allow|deny]\', CallAclId INT UNSIGNED NOT NULL, matchListId INT UNSIGNED NOT NULL, INDEX callAclId (callAclId), INDEX callAclPatternId (matchListId), UNIQUE INDEX unique_callAclId_priority (callAclId, priority), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8  ENGINE = InnoDB');
        $this->addSql('ALTER TABLE CallAclRelMatchLists ADD CONSTRAINT FK_A09BB69548DE28A4 FOREIGN KEY (CallAclId) REFERENCES CallACL (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CallAclRelMatchLists ADD CONSTRAINT FK_A09BB695283E7346 FOREIGN KEY (matchListId) REFERENCES MatchLists (id) ON DELETE CASCADE');


        $this->addSql('ALTER TABLE MatchLists ADD genericCallAclPatternId INT UNSIGNED DEFAULT NULL');
        $this->addSql('INSERT INTO MatchLists (brandId, name, genericCallAclPatternId) SELECT brandId, CONCAT("Generic ACL ", name), id FROM GenericCallACLPatterns');
        $this->addSql('INSERT INTO MatchListPatterns (matchListId, description, type, `regExp`) SELECT ML.id, ML.name, "regexp", GCAP.`regexp` FROM MatchLists ML INNER JOIN GenericCallACLPatterns GCAP ON ML.genericCallAclPatternId = GCAP.id');
        $this->addSql('ALTER TABLE MatchLists DROP genericCallAclPatternId');

        $this->addSql('ALTER TABLE MatchLists ADD callAclPatternId INT UNSIGNED DEFAULT NULL');
        $this->addSql('INSERT INTO MatchLists (companyId, name, callAclPatternId) SELECT companyId, CONCAT("ACL ", name), id FROM CallACLPatterns');
        $this->addSql('INSERT INTO MatchListPatterns (matchListId, description, type, `regExp`) SELECT ML.id, ML.name, "regexp", CAP.`regexp` FROM MatchLists ML INNER JOIN CallACLPatterns CAP ON ML.callAclPatternId = CAP.id');
        $this->addSql('INSERT INTO CallAclRelMatchLists (callAclId, matchListId, priority, policy) SELECT CARP.CallACLId, ML.id, CARP.priority, policy FROM CallACLRelPatterns CARP INNER JOIN MatchLists ML ON ML.callAclPatternId = CARP.CallACLPatternId');
        $this->addSql('ALTER TABLE MatchLists DROP callAclPatternId');

        $this->addSql('DROP TABLE CallACLPatterns');
        $this->addSql('DROP TABLE CallACLRelPatterns');
        $this->addSql('DROP TABLE GenericCallACLPatterns');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE CallACLPatterns (id INT UNSIGNED AUTO_INCREMENT NOT NULL, companyId INT UNSIGNED NOT NULL, name VARCHAR(50) NOT NULL , `regExp` VARCHAR(255) NOT NULL , UNIQUE INDEX nameCompany (name, companyId), INDEX companyId (companyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8  ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CallACLRelPatterns (id INT UNSIGNED AUTO_INCREMENT NOT NULL, CallACLId INT UNSIGNED NOT NULL, CallACLPatternId INT UNSIGNED NOT NULL, priority SMALLINT NOT NULL, policy VARCHAR(25) NOT NULL  COMMENT \'[enum:allow|deny]\', UNIQUE INDEX unique_callACLId_priority (CallACLId, priority), INDEX CallACLId (CallACLId), INDEX CallACLPatternId (CallACLPatternId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8  ENGINE = InnoDB');
        $this->addSql('CREATE TABLE GenericCallACLPatterns (id INT UNSIGNED AUTO_INCREMENT NOT NULL, brandId INT UNSIGNED NOT NULL, name VARCHAR(50) NOT NULL , `regExp` VARCHAR(255) NOT NULL , UNIQUE INDEX nameBrand (name, brandId), INDEX brandId (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8  ENGINE = InnoDB');
        
        $this->addSql('ALTER TABLE CallACLPatterns ADD CONSTRAINT CallACLPatterns_ibfk_1 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CallACLRelPatterns ADD CONSTRAINT CallACLRelPatterns_ibfk_1 FOREIGN KEY (CallACLId) REFERENCES CallACL (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CallACLRelPatterns ADD CONSTRAINT CallACLRelPatterns_ibfk_2 FOREIGN KEY (CallACLPatternId) REFERENCES CallACLPatterns (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE GenericCallACLPatterns ADD CONSTRAINT GenericCallACLPatterns_ibfk_1 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE CallAclRelMatchLists');

        $this->addSql('ALTER TABLE MatchLists DROP FOREIGN KEY FK_BAF072189CBEC244');
        $this->addSql('DROP INDEX brandId ON MatchLists');
        $this->addSql('DROP INDEX listName ON MatchLists');

        $this->addSql('DELETE FROM MatchLists WHERE name LIKE "%ACL%"');

        $this->addSql('ALTER TABLE MatchLists DROP brandId, CHANGE companyId companyId INT UNSIGNED NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX matchName ON MatchLists (companyId, name)');
    }
}
