<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180906173440 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE OutgoingRouting ADD prefix VARCHAR(25) DEFAULT NULL, ADD forceClid tinyint(1) unsigned DEFAULT \'0\', ADD clid VARCHAR(25) DEFAULT NULL, ADD clidCountryId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE OutgoingRouting ADD CONSTRAINT FK_56931472FDDAED95 FOREIGN KEY (clidCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_56931472FDDAED95 ON OutgoingRouting (clidCountryId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE OutgoingRouting DROP FOREIGN KEY FK_56931472FDDAED95');
        $this->addSql('DROP INDEX IDX_56931472FDDAED95 ON OutgoingRouting');
        $this->addSql('ALTER TABLE OutgoingRouting DROP prefix, DROP forceClid, DROP clid, DROP clidCountryId');
    }
}
