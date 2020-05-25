<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200525104541 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("UPDATE ast_ps_endpoints APE JOIN ResidentialDevices RD ON RD.id=APE.residentialDeviceId SET APE.mailboxes=CONCAT('residential', APE.residentialDeviceId, '@company', RD.companyId) WHERE APE.residentialDeviceId IS NOT NULL");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("UPDATE ast_ps_endpoints SET mailboxes=NULL WHERE residentialDeviceId IS NOT NULL");
    }
}
