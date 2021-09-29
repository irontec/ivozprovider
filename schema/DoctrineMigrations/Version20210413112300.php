<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413112300 extends LoggableMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function isTransactional() : bool
    {
        return false;
    }

    public function up(Schema $schema) : void
    {
        // https://www.kamailio.org/wiki/install/upgrade/5.1.x-to-5.2.0

        $this->addSql("ALTER TABLE kam_users_location_attrs CHANGE COLUMN avalue avalue VARCHAR(512) NOT NULL DEFAULT ''");
        $this->addSql("ALTER TABLE kam_users_presentity CHANGE COLUMN etag etag VARCHAR(128) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_presentity ADD COLUMN ruid VARCHAR(64)");
        $this->addSql("CREATE UNIQUE INDEX kam_users_presentity_ruid_idx ON kam_users_presentity (ruid)");
        $this->addSql("UPDATE kam_version SET table_version=5 WHERE TABLE_NAME='kam_users_presentity'");
        $this->addSql("ALTER TABLE kam_users_pua CHANGE COLUMN etag etag VARCHAR(128) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_xcap CHANGE COLUMN etag etag VARCHAR(128) NOT NULL");

        // https://www.kamailio.org/wiki/install/upgrade/5.2.x-to-5.3.0

        $this->addSql("ALTER TABLE kam_users_active_watchers CHANGE COLUMN contact contact VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_active_watchers CHANGE COLUMN from_tag from_tag VARCHAR(128) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_active_watchers CHANGE COLUMN to_tag to_tag VARCHAR(128) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_active_watchers CHANGE COLUMN presentity_uri presentity_uri VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_active_watchers CHANGE COLUMN local_contact local_contact VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_presentity CHANGE COLUMN sender sender VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_pua CHANGE COLUMN remote_contact remote_contact VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_pua CHANGE COLUMN watcher_uri watcher_uri VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_pua CHANGE COLUMN contact contact VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_pua CHANGE COLUMN to_tag to_tag VARCHAR(128) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_pua CHANGE COLUMN from_tag from_tag VARCHAR(128) NOT NULL");
        $this->addSql("ALTER TABLE kam_users_pua CHANGE COLUMN pres_uri pres_uri VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE kam_trunks_uacreg CHANGE COLUMN auth_proxy auth_proxy VARCHAR(255) NOT NULL DEFAULT ''");
        $this->addSql("ALTER TABLE kam_trunks_uacreg ADD COLUMN socket VARCHAR(128) NOT NULL DEFAULT ''");
        $this->addSql("UPDATE kam_version SET table_version=4 WHERE TABLE_NAME='kam_trunks_uacreg'");
        $this->addSql("ALTER TABLE kam_users_watchers CHANGE COLUMN presentity_uri presentity_uri VARCHAR(255) NOT NULL");

        // https://www.kamailio.org/wiki/install/upgrade/5.3.x-to-5.4.0
        $this->addSql("ALTER TABLE `kam_version` ADD COLUMN `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (`id`)");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
