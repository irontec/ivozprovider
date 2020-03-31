<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200812105255 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT IGNORE INTO TerminalManufacturers (iden, name) VALUES ('Snom', 'Snom')");
        $this->addSql("INSERT IGNORE INTO TerminalModels (iden, name, genericUrlPattern, specificUrlPattern, TerminalManufacturerId) SELECT 'SnomD375', 'SnomD375', 'snomD375.htm', '{mac}', id FROM TerminalManufacturers WHERE iden='Snom'");
        $this->addSql("INSERT IGNORE INTO TerminalModels (iden, name, genericUrlPattern, specificUrlPattern, TerminalManufacturerId) SELECT 'SnomD717', 'SnomD717', 'snomD717.htm', '{mac}', id FROM TerminalManufacturers WHERE iden='Snom'");
        $this->addSql("INSERT IGNORE INTO TerminalModels (iden, name, genericUrlPattern, specificUrlPattern, TerminalManufacturerId) SELECT 'SnomD735', 'SnomD735', 'snomD735.htm', '{mac}', id FROM TerminalManufacturers WHERE iden='Snom'");
        $this->addSql("INSERT IGNORE INTO TerminalModels (iden, name, genericUrlPattern, specificUrlPattern, TerminalManufacturerId) SELECT 'SnomD785', 'SnomD785', 'snomD785.htm', '{mac}', id FROM TerminalManufacturers WHERE iden='Snom'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
