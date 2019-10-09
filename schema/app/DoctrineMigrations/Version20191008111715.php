<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191008111715 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('UPDATE MatchListPatterns SET `regExp` = REPLACE(`regExp`, "^+", "^\\\\+")');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
