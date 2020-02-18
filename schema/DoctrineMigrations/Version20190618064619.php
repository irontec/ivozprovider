<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190618064619 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE QueueMembers CHANGE queueId queueId INT UNSIGNED NOT NULL, CHANGE userId userId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE CallForwardSettings CHANGE targetType targetType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:number|extension|voicemail]\'');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallForwardSettings CHANGE targetType targetType VARCHAR(25) NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:number|extension|voicemail]\'');
        $this->addSql('ALTER TABLE QueueMembers CHANGE queueId queueId INT UNSIGNED DEFAULT NULL, CHANGE userId userId INT UNSIGNED DEFAULT NULL');
    }
}
