<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171031161520 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
		$this->addSql('UPDATE TargetPatterns SET `regExp` = CONCAT("\+", `regExp`)');
		$this->addSql('UPDATE MatchListPatterns SET `regExp` = REPLACE(`regExp`, "^", "^+")');
        $this->addSql('UPDATE MatchListPatterns SET `regExp` = REPLACE(`regExp`, "[^+", "[^")');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
		$this->addSql('UPDATE TargetPatterns SET `regExp` = TRIM(LEADING "\+" FROM `regExp`)');
		$this->addSql('UPDATE MatchListPatterns SET `regExp` = REPLACE(`regExp`, "^+", "^")');

    }
}
