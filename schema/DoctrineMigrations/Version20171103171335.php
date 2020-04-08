<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171103171335 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE kam_trunks_acc');
        $this->addSql('DROP TABLE kam_users_acc');
        $this->addSql('DELETE FROM kam_version WHERE table_name="kam_users_acc"');
        $this->addSql('DELETE FROM kam_version WHERE table_name="kam_trunks_acc"');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kam_trunks_acc (id INT UNSIGNED AUTO_INCREMENT NOT NULL, method VARCHAR(16) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, from_tag VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, to_tag VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, callid VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, sip_code VARCHAR(3) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, sip_reason VARCHAR(128) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, src_ip VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, from_user VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, from_domain VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, ruri_user VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, ruri_domain VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, cseq INT UNSIGNED DEFAULT NULL, `localtime` DATETIME NOT NULL, utctime VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, INDEX callid_idx (callid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kam_users_acc (id INT UNSIGNED AUTO_INCREMENT NOT NULL, method VARCHAR(16) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, from_tag VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, to_tag VARCHAR(64) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, callid VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, sip_code VARCHAR(3) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, sip_reason VARCHAR(128) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, src_ip VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, from_user VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, from_domain VARCHAR(190) DEFAULT NULL COLLATE utf8_general_ci, ruri_user VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, ruri_domain VARCHAR(190) DEFAULT NULL COLLATE utf8_general_ci, cseq INT UNSIGNED DEFAULT NULL, `localtime` DATETIME NOT NULL, utctime VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, INDEX callid_idx (callid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql("INSERT INTO kam_version (table_name, table_version) VALUES ('kam_users_acc', 5)");
        $this->addSql("INSERT INTO kam_version (table_name, table_version) VALUES ('kam_trunks_acc', 5)");
    }
}
