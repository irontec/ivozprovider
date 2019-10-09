<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190919120015 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tp_derived_chargers CHANGE run_filters run_filters VARCHAR(32) DEFAULT \'\' NOT NULL, CHANGE req_type_field req_type_field VARCHAR(64) DEFAULT \'^*postpaid\' NOT NULL');
        $this->addSql("UPDATE tp_derived_chargers SET run_filters='',req_type_field='^*postpaid'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("UPDATE tp_derived_chargers SET run_filters='carrierId',req_type_field='carrierReqtype'");
        $this->addSql('ALTER TABLE tp_derived_chargers CHANGE run_filters run_filters VARCHAR(32) DEFAULT \'carrierId\' NOT NULL COLLATE utf8_unicode_ci, CHANGE req_type_field req_type_field VARCHAR(64) DEFAULT \'carrierReqtype\' NOT NULL COLLATE utf8_unicode_ci');
    }
}
