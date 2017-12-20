<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171130105757 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX calldate_idx ON kam_acc_cdrs');
        $this->addSql('ALTER TABLE kam_acc_cdrs DROP start_time_utc, DROP end_time_utc');
        $this->addSql('CREATE INDEX calldate_idx ON kam_acc_cdrs (end_time)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX calldate_idx ON kam_acc_cdrs');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD start_time_utc DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', ADD end_time_utc DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\'');
        $this->addSql('CREATE INDEX calldate_idx ON kam_acc_cdrs (end_time_utc)');
    }
}
