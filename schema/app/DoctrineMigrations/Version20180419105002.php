<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180419105002 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kam_trusted (id INT UNSIGNED AUTO_INCREMENT NOT NULL, src_ip VARCHAR(50) DEFAULT NULL, proto VARCHAR(4) DEFAULT NULL, from_pattern VARCHAR(64) DEFAULT NULL, ruri_pattern VARCHAR(64) DEFAULT NULL, tag VARCHAR(64) DEFAULT NULL, description VARCHAR(200) DEFAULT NULL, priority INT DEFAULT 0 NOT NULL, companyId INT UNSIGNED DEFAULT NULL, INDEX trusted_companyId (companyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kam_trusted ADD CONSTRAINT FK_10A58A572480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO kam_trusted (src_ip, proto, from_pattern, ruri_pattern, description, priority) SELECT src_ip, proto, from_pattern, ruri_pattern, tag, priority FROM kam_pike_trusted');
        $this->addSql('CREATE UNIQUE INDEX src_ip ON kam_trusted (src_ip)');
        $this->addSql('DROP TABLE kam_pike_trusted');
        $this->addSql('UPDATE kam_version SET table_name="kam_trusted" WHERE table_name="kam_pike_trusted"');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kam_pike_trusted (id INT UNSIGNED AUTO_INCREMENT NOT NULL, src_ip VARCHAR(50) DEFAULT NULL COLLATE utf8_general_ci, proto VARCHAR(4) DEFAULT NULL COLLATE utf8_general_ci, from_pattern VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, ruri_pattern VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, tag VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, priority INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO kam_pike_trusted (src_ip, proto, from_pattern, ruri_pattern, tag, priority) SELECT src_ip, proto, from_pattern, ruri_pattern, description, priority FROM kam_trusted');
        $this->addSql('DROP TABLE kam_trusted');
        $this->addSql('UPDATE kam_version SET table_name="kam_pike_trusted" WHERE table_name="kam_trusted"');
    }
}
