<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181019153700 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql(
          'INSERT IGNORE INTO ast_voicemail (
                context,
                mailbox,
                tz
            ) SELECT CONCAT("residential", id),
              CONCAT("company", companyId),
              "Europe/Madrid"
              FROM ResidentialDevices'
        );

        $this->addSql('UPDATE ast_voicemail SET mailbox = CONCAT("residential", residentialDeviceId) WHERE residentialDeviceId IS NOT NULL');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DELETE FROM ast_voicemail WHERE residentialDeviceId IS NOT NULL");
    }
}
