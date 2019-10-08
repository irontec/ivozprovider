<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191008111009 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("UPDATE OutgoingDDIRulesPatterns SET type = 'destination' WHERE matchListId IS NOT NULL");
        $this->addSql("UPDATE OutgoingDDIRulesPatterns SET type = 'prefix' WHERE prefix IS NOT NULL");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
