<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171121171116 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE MusicOnHold ADD brandId INT UNSIGNED DEFAULT NULL AFTER id, CHANGE companyId companyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE MusicOnHold ADD CONSTRAINT FK_9C5FB5909CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX brandId ON MusicOnHold (brandId)');
        $this->addSql('CREATE UNIQUE INDEX nameBrand ON MusicOnHold (name, brandId)');

        $this->addSql('INSERT INTO MusicOnHold (name, originalFileFileSize, originalFileMimeType, originalFileBaseName, encodedFileFileSize, encodedFileMimeType, encodedFileBaseName, status, brandId) SELECT name, originalFileFileSize, originalFileMimeType, originalFileBaseName, encodedFileFileSize, encodedFileMimeType, encodedFileBaseName, status, brandId FROM GenericMusicOnHold');
        $this->addSql('DROP TABLE GenericMusicOnHold');

        $this->addSql('DROP TABLE ast_musiconhold');
        $this->addSql('CREATE VIEW ast_musiconhold AS SELECT CONCAT("brand", brandId) as name, "files" as mode, CONCAT("moh/custom/brand", brandId) AS directory FROM MusicOnHold WHERE brandId IS NOT NULL GROUP BY brandId UNION SELECT CONCAT("company", companyId) as name, "files" as mode, CONCAT("moh/custom/company", companyId) AS directory FROM MusicOnHold WHERE companyId IS NOT NULL GROUP BY companyId');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE GenericMusicOnHold (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL , originalFileFileSize INT UNSIGNED DEFAULT NULL COMMENT \'[FSO:keepExtension]\', originalFileMimeType VARCHAR(80) DEFAULT NULL , originalFileBaseName VARCHAR(255) DEFAULT NULL , encodedFileFileSize INT UNSIGNED DEFAULT NULL COMMENT \'[FSO:keepExtension|storeInBaseFolder]\', encodedFileMimeType VARCHAR(80) DEFAULT NULL , encodedFileBaseName VARCHAR(255) DEFAULT NULL , status VARCHAR(20) DEFAULT NULL  COMMENT \'[enum:pending|encoding|ready|error]\', brandId INT UNSIGNED NOT NULL, UNIQUE INDEX nameBrand (name, brandId), INDEX fGenericMusicOnHold_ibfk_1 (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8  ENGINE = InnoDB');
        $this->addSql('ALTER TABLE GenericMusicOnHold ADD CONSTRAINT FK_F9FA93559CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO GenericMusicOnHold (name, originalFileFileSize, originalFileMimeType, originalFileBaseName, encodedFileFileSize, encodedFileMimeType, encodedFileBaseName, status, brandId) SELECT name, originalFileFileSize, originalFileMimeType, originalFileBaseName, encodedFileFileSize, encodedFileMimeType, encodedFileBaseName, status, brandId FROM MusicOnHold WHERE brandId IS NOT NULL');
        $this->addSql('DELETE FROM MusicOnHold WHERE brandId IS NOT NULL');

        $this->addSql('ALTER TABLE MusicOnHold DROP FOREIGN KEY FK_9C5FB5909CBEC244');
        $this->addSql('DROP INDEX brandId ON MusicOnHold');
        $this->addSql('DROP INDEX nameBrand ON MusicOnHold');
        $this->addSql('ALTER TABLE MusicOnHold DROP brandId, CHANGE companyId companyId INT UNSIGNED NOT NULL');

        $this->addSql('DROP VIEW ast_musiconhold');
        $this->addSql('CREATE TABLE ast_musiconhold (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL , mode VARCHAR(255) DEFAULT NULL , directory VARCHAR(255) DEFAULT NULL , application VARCHAR(255) DEFAULT NULL , digit VARCHAR(1) DEFAULT NULL , sort VARCHAR(10) DEFAULT NULL , format VARCHAR(10) DEFAULT NULL , stamp DATETIME DEFAULT NULL, UNIQUE INDEX name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8  ENGINE = InnoDB');
        $this->addSql('INSERT INTO ast_musiconhold (name, mode, directory) SELECT CONCAT("brand", brandId), "files", CONCAT("/opt/irontec/ivozprovider/storage/ivozprovider_model_genericmusiconhold.encodedfile/brand", brandId) FROM GenericMusicOnHold GROUP BY brandId');
        $this->addSql('INSERT INTO ast_musiconhold (name, mode, directory) SELECT CONCAT("company", companyId), "files", CONCAT("/opt/irontec/ivozprovider/storage/ivozprovider_model_musiconhold.encodedfile/company", companyId) FROM MusicOnHold GROUP BY companyId');
        
    }
}
