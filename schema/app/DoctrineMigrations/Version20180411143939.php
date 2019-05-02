<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180411143939 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kam_rtpengine (id INT UNSIGNED AUTO_INCREMENT NOT NULL, setid INT DEFAULT 0 NOT NULL, url VARCHAR(64) NOT NULL, weight INT UNSIGNED DEFAULT 1 NOT NULL, disabled TINYINT(1) DEFAULT \'0\' NOT NULL, stamp DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', description VARCHAR(200) DEFAULT NULL, mediaRelaySetsId INT UNSIGNED DEFAULT NULL, INDEX rtpengine_mediaRelaySetsId (mediaRelaySetsId), UNIQUE INDEX rtpengine_nodes (setid, url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kam_rtpengine ADD CONSTRAINT FK_C5AB1ADEC8555117 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON DELETE CASCADE');
        $this->addSql("ALTER TABLE MediaRelaySets ADD type VARCHAR(64) NOT NULL DEFAULT 'rtpproxy' COMMENT '[enum:rtpengine|rtpproxy]'");
        $this->addSql('INSERT INTO kam_version (table_name, table_version) values ("kam_rtpengine","1")');

        $this->addSql("UPDATE MediaRelaySets SET name='Default-rtpproxy', description='Default rtpproxy set' WHERE id=0");
        $this->addSql("INSERT INTO MediaRelaySets (name, description, type) VALUES ('Default-rtpengine','Default rtpengine set','rtpengine')");
        $this->addSql('INSERT INTO kam_rtpengine (setid, url, description, mediaRelaySetsId) VALUES ((SELECT id FROM MediaRelaySets WHERE type="rtpengine" LIMIT 1),"udp:127.0.0.1:22223","Default rtpengine set",(SELECT id FROM MediaRelaySets WHERE type="rtpengine" LIMIT 1))');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE kam_rtpengine');
        $this->addSql('ALTER TABLE MediaRelaySets DROP type');
        $this->addSql("DELETE FROM kam_version WHERE table_name='kam_rtpengine'");
        $this->addSql("UPDATE MediaRelaySets SET name='Default',description='Default media relay set' WHERE id=0");
        $this->addSql("DELETE FROM MediaRelaySets WHERE name='Default-rtpengine'");
    }
}
