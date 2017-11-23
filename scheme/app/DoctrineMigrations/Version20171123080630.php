<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171123080630 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Commandlog ADD microtime SMALLINT NOT NULL');
        $this->addSql('CREATE INDEX createdOn ON Commandlog (createdOn)');
        $this->addSql('ALTER TABLE Changelog ADD microtime SMALLINT NOT NULL');
        $this->addSql('CREATE INDEX createdOn ON Changelog (createdOn)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX createdOn ON Changelog');
        $this->addSql('ALTER TABLE Changelog DROP microtime');
        $this->addSql('DROP INDEX createdOn ON Commandlog');
        $this->addSql('ALTER TABLE Commandlog DROP microtime');
    }
}
