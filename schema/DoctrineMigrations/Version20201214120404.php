<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20201214120404 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('UPDATE ast_voicemail SET callback="users" WHERE userId IS NOT NULL');
        $this->addSql('UPDATE ast_voicemail SET callback="residential" WHERE residentialDeviceId IS NOT NULL');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('UPDATE ast_voicemail SET callback=NULL');
    }
}
