<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180410164407 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        # Kamailio 4.4 to 5.0 database changes (https://www.kamailio.org/wiki/install/upgrade/4.4.x-to-5.0.0)
        $this->addSql('ALTER TABLE kam_trunks_uacreg ADD auth_ha1 VARCHAR(128) DEFAULT \'\' NOT NULL');
        $this->addSql('UPDATE kam_version SET table_version=3 WHERE TABLE_NAME="kam_trunks_uacreg"');

        # Kamailio 5.0 to 5.1 database changes (https://www.kamailio.org/wiki/install/upgrade/5.0.x-to-5.1.0)
        $this->addSql('ALTER TABLE LcrRules ADD mt_tvalue VARCHAR(128) DEFAULT NULL');
        $this->addSql('UPDATE kam_version SET table_version=3 WHERE TABLE_NAME=\'LcrRules\'');

        $this->addSql('ALTER TABLE kam_users_location CHANGE contact contact VARCHAR(512) DEFAULT \'\' NOT NULL');
        $this->addSql('UPDATE kam_version SET table_version=9 WHERE TABLE_NAME=\'kam_users_location\'');

        $this->addSql('ALTER TABLE kam_users_active_watchers CHANGE reason reason VARCHAR(64) DEFAULT NULL');

        $this->addSql('DROP INDEX domain_attrs_idx ON kam_trunks_domain_attrs');
        $this->addSql('CREATE UNIQUE INDEX domain_attrs_idx ON kam_trunks_domain_attrs (did, name)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        # Revert Kamailio 5.0 to 5.1 database changes
        $this->addSql('DROP INDEX domain_attrs_idx ON kam_trunks_domain_attrs');
        $this->addSql('CREATE UNIQUE INDEX domain_attrs_idx ON kam_trunks_domain_attrs (did, name, value)');

        $this->addSql('ALTER TABLE kam_users_active_watchers CHANGE reason reason VARCHAR(64) NOT NULL COLLATE utf8_general_ci');

        $this->addSql('ALTER TABLE kam_users_location CHANGE contact contact VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci');
        $this->addSql('UPDATE kam_version SET table_version=8 WHERE TABLE_NAME=\'kam_users_location\'');

        # Revert Kamailio 4.4 to 5.0 database changes
        $this->addSql('ALTER TABLE LcrRules DROP mt_tvalue');
        $this->addSql('UPDATE kam_version SET table_version=2 WHERE TABLE_NAME=\'LcrRules\'');


        $this->addSql('ALTER TABLE kam_trunks_uacreg DROP auth_ha1');
        $this->addSql('UPDATE kam_version SET table_version=2 WHERE TABLE_NAME="kam_trunks_uacreg"');
    }
}
