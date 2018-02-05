<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171030065859 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Commandlog (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', requestId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', class VARCHAR(50) NOT NULL, method VARCHAR(64) DEFAULT NULL, arguments LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', createdOn DATETIME NOT NULL, INDEX requestId (requestId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Changelog (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', entity VARCHAR(150) NOT NULL, entityId VARCHAR(36) NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', createdOn DATETIME NOT NULL, commandId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX commandId (commandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Changelog ADD CONSTRAINT FK_4AB3A4A28F36C645 FOREIGN KEY (commandId) REFERENCES Commandlog (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ChangeHistory');

        $this->addSql('ALTER TABLE Commandlog ADD microtime SMALLINT NOT NULL');
        $this->addSql('CREATE INDEX createdOn ON Commandlog (createdOn)');
        $this->addSql('ALTER TABLE Changelog ADD microtime SMALLINT NOT NULL');
        $this->addSql('CREATE INDEX createdOn ON Changelog (createdOn)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Changelog DROP FOREIGN KEY FK_4AB3A4A28F36C645');
        $this->addSql('CREATE TABLE ChangeHistory (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user VARCHAR(50) NOT NULL COLLATE utf8_general_ci, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, action VARCHAR(15) NOT NULL COLLATE utf8_general_ci, `table` VARCHAR(50) NOT NULL COLLATE utf8_general_ci, objid INT UNSIGNED NOT NULL, field VARCHAR(50) NOT NULL COLLATE utf8_general_ci, old_value VARCHAR(250) DEFAULT NULL COLLATE utf8_general_ci, new_value VARCHAR(250) DEFAULT NULL COLLATE utf8_general_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE Commandlog');
        $this->addSql('DROP TABLE Changelog');
    }
}
