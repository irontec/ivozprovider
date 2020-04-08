<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180405103050 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tp_rating_plans DROP FOREIGN KEY FK_4CC2BCAB8E5B4C15');
        $this->addSql('ALTER TABLE tp_rating_plans CHANGE timing_tag timing_tag VARCHAR(64) DEFAULT \'*any\' NOT NULL, CHANGE timingId timingId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE tp_rating_plans ADD CONSTRAINT FK_4CC2BCAB8E5B4C15 FOREIGN KEY (timingId) REFERENCES tp_timings (id) ON DELETE SET NULL');

        // Set all timing_tags to '*any'
        $this->addSql('UPDATE tp_rating_plans SET timingId=NULL,timing_tag=\'*any\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Set all timing_tags to 'ALWAYS'
        $this->addSql('UPDATE tp_rating_plans SET timingId=1,timing_tag=\'ALWAYS\'');

        $this->addSql('ALTER TABLE tp_rating_plans DROP FOREIGN KEY FK_4CC2BCAB8E5B4C15');
        $this->addSql('ALTER TABLE tp_rating_plans CHANGE timing_tag timing_tag VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, CHANGE timingId timingId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_rating_plans ADD CONSTRAINT FK_4CC2BCAB8E5B4C15 FOREIGN KEY (timingId) REFERENCES tp_timings (id) ON DELETE CASCADE');
    }
}
