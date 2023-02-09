<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331091438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE kam_users_active_watchers');
        $this->addSql('DROP TABLE kam_users_presentity');
        $this->addSql('DROP TABLE kam_users_pua');
        $this->addSql('DROP TABLE kam_users_watchers');
        $this->addSql('DROP TABLE kam_users_xcap');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kam_users_active_watchers (id INT UNSIGNED AUTO_INCREMENT NOT NULL, presentity_uri VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, watcher_username VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, watcher_domain VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, to_user VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, to_domain VARCHAR(190) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, event VARCHAR(64) CHARACTER SET utf8 DEFAULT \'presence\' NOT NULL COLLATE `utf8_general_ci`, event_id VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, to_tag VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, from_tag VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, callid VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, local_cseq INT NOT NULL, remote_cseq INT NOT NULL, contact VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, record_route TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, expires INT NOT NULL, status INT DEFAULT 2 NOT NULL, reason VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, version INT DEFAULT 0 NOT NULL, socket_info VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, local_contact VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, from_user VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, from_domain VARCHAR(190) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, updated INT NOT NULL, updated_winfo INT NOT NULL, flags INT DEFAULT 0 NOT NULL, user_agent VARCHAR(255) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_general_ci`, UNIQUE INDEX kam_users_active_watchers_idx (callid, to_tag, from_tag), INDEX usersActiveWatcher_expires (expires), INDEX usersActiveWatcher_pres (presentity_uri, event), INDEX usersActiveWatcher_updated_idx (updated), INDEX usersActiveWatcher_updated_winfo_idx (updated_winfo, presentity_uri), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'[ignore]\' ');
        $this->addSql('CREATE TABLE kam_users_presentity (id INT UNSIGNED AUTO_INCREMENT NOT NULL, username VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, domain VARCHAR(190) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, event VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, etag VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, expires INT NOT NULL, received_time INT NOT NULL, body BLOB NOT NULL, sender VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, priority INT DEFAULT 0 NOT NULL, ruid VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, UNIQUE INDEX kam_users_presentity_idx (username, domain, event, etag), UNIQUE INDEX kam_users_presentity_ruid_idx (ruid), INDEX usersPresentity_expires (expires), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'[ignore]\' ');
        $this->addSql('CREATE TABLE kam_users_pua (id INT UNSIGNED AUTO_INCREMENT NOT NULL, pres_uri VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, pres_id VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, event INT NOT NULL, expires INT NOT NULL, desired_expires INT NOT NULL, flag INT NOT NULL, etag VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, tuple_id VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, watcher_uri VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, call_id VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, to_tag VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, from_tag VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, cseq INT NOT NULL, record_route TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, contact VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, remote_contact VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, version INT NOT NULL, extra_headers TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, UNIQUE INDEX kam_users_pua_idx (etag, tuple_id, call_id, from_tag), INDEX usersPua_dialog1_idx (pres_id, pres_uri), INDEX usersPua_dialog2_idx (call_id, from_tag), INDEX usersPua_expires_idx (expires), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'[ignore]\' ');
        $this->addSql('CREATE TABLE kam_users_watchers (id INT UNSIGNED AUTO_INCREMENT NOT NULL, presentity_uri VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, watcher_username VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, watcher_domain VARCHAR(190) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, event VARCHAR(64) CHARACTER SET utf8 DEFAULT \'presence\' NOT NULL COLLATE `utf8_general_ci`, status INT NOT NULL, reason VARCHAR(64) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, inserted_time INT NOT NULL, UNIQUE INDEX kam_users_watchers_idx (presentity_uri, watcher_username, watcher_domain, event), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'[ignore]\' ');
        $this->addSql('CREATE TABLE kam_users_xcap (id INT UNSIGNED AUTO_INCREMENT NOT NULL, username VARCHAR(64) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, domain VARCHAR(190) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, doc MEDIUMBLOB NOT NULL, doc_type INT NOT NULL, etag VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, source INT NOT NULL, doc_uri VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, port INT NOT NULL, UNIQUE INDEX doc_uri_idx (doc_uri), INDEX UsersXcap_account_doc_type_uri_idx (username, domain, doc_type, doc_uri), INDEX UsersXcap_account_doc_uri_idx (username, domain, doc_uri), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'[ignore]\' ');
    }
}
