<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180220144935 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('DROP TABLE kam_users_missed_calls');
        $this->addSql('DELETE FROM kam_version WHERE table_name="kam_users_missed_calls"');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('CREATE TABLE `kam_users_missed_calls` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT, `method` varchar(16) NOT NULL DEFAULT \'\', `from_tag` varchar(64) NOT NULL DEFAULT \'\', `to_tag` varchar(64) NOT NULL DEFAULT \'\', `callid` varchar(255) NOT NULL DEFAULT \'\', `sip_code` varchar(3) NOT NULL DEFAULT \'\', `sip_reason` varchar(128) NOT NULL DEFAULT \'\', `src_ip` varchar(64) DEFAULT NULL, `from_user` varchar(64) DEFAULT NULL, `from_domain` varchar(190) DEFAULT NULL, `ruri_user` varchar(64) DEFAULT NULL, `ruri_domain` varchar(190) DEFAULT NULL, `cseq` int(10) unsigned DEFAULT NULL, `localtime` datetime NOT NULL, `utctime` varchar(128) DEFAULT NULL, PRIMARY KEY (`id`), KEY `usersMissedCall_callid_idx` (`callid`)) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addSql("INSERT INTO kam_version (table_name, table_version) VALUES ('kam_users_missed_calls', 4)");
    }
}
