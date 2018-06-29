<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180619114825 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DELETE FROM MediaRelaySets');
        $this->addSql('ALTER TABLE MediaRelaySets DROP type');
        $this->addSql('DELETE FROM kam_rtpengine');
        $this->addSql('DROP TABLE kam_rtpproxy');
        $this->addSql("DELETE FROM kam_version WHERE `table_name`='kam_rtpproxy'");

        // Add default RtpEngine media relay
        $this->addSql("INSERT INTO MediaRelaySets (name, description) VALUES ('Default','Default media relay set')");
        $this->addSql("UPDATE MediaRelaySets SET id = 0");
        $this->addSql('INSERT INTO kam_rtpengine (setid, url, description, mediaRelaySetsId) VALUES (0,"udp:127.0.0.1:22223","Default rtpengine set", 0)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE MediaRelaySets ADD type VARCHAR(64) DEFAULT \'rtpproxy\' NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:rtpengine|rtpproxy]\'');
        $this->addSql('CREATE TABLE kam_rtpproxy (id INT UNSIGNED AUTO_INCREMENT NOT NULL, setid VARCHAR(32) DEFAULT \'0\' NOT NULL COLLATE utf8_general_ci, url VARCHAR(128) NOT NULL COLLATE utf8_general_ci, flags INT UNSIGNED DEFAULT 0 NOT NULL, weight INT UNSIGNED DEFAULT 1 NOT NULL, description VARCHAR(200) DEFAULT NULL COLLATE utf8_general_ci, mediaRelaySetsId INT UNSIGNED DEFAULT NULL, INDEX rtpproxy_mediaRelaySetsId (mediaRelaySetsId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kam_rtpproxy ADD CONSTRAINT FK_729D1741C8555117 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON DELETE CASCADE');
        $this->addSql("INSERT INTO kam_version (table_name, table_version) VALUES ('kam_rtpproxy', 1)");

    }
}
