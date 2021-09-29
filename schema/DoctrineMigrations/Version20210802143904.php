<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802143904 extends LoggableMigration
{
    public function isTransactional() : bool
    {
        return false;
    }

    public function up(Schema $schema) : void
    {
        // https://www.kamailio.org/wiki/install/upgrade/5.4.x-to-5.5.0
        $this->addSql("ALTER TABLE kam_trunks_uacreg ADD contact_addr VARCHAR(255) NOT NULL DEFAULT ''");
        $this->addSql("UPDATE kam_version SET table_version=5 WHERE TABLE_NAME='kam_trunks_uacreg'");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("UPDATE kam_version SET table_version=4 WHERE TABLE_NAME='kam_trunks_uacreg'");
        $this->addSql("ALTER TABLE kam_trunks_uacreg DROP contact_addr");
    }
}
