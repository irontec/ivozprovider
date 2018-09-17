<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180802142456 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX IDX_4CC2BCAB4EB67480 ON tp_rating_plans');
        $this->addSql('ALTER TABLE tp_rating_plans ADD timing_type VARCHAR(10) DEFAULT \'always\' COMMENT \'[enum:always|custom]\', ADD time_in TIME NOT NULL, ADD monday TINYINT(1) DEFAULT \'1\', ADD tuesday TINYINT(1) DEFAULT \'1\', ADD wednesday TINYINT(1) DEFAULT \'1\', ADD thursday TINYINT(1) DEFAULT \'1\', ADD friday TINYINT(1) DEFAULT \'1\', ADD saturday TINYINT(1) DEFAULT \'1\', ADD sunday TINYINT(1) DEFAULT \'1\', CHANGE destinationrateid destinationRateGroupId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_rating_plans ADD CONSTRAINT FK_4CC2BCABC11683D9 FOREIGN KEY (destinationRateGroupId) REFERENCES DestinationRateGroups (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4CC2BCABC11683D9 ON tp_rating_plans (destinationRateGroupId)');

        // Delete ALWAYS unused timing
        $this->addSql("DELETE FROM tp_timings WHERE tag='ALWAYS'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tp_rating_plans DROP FOREIGN KEY FK_4CC2BCABC11683D9');
        $this->addSql('DROP INDEX IDX_4CC2BCABC11683D9 ON tp_rating_plans');
        $this->addSql('ALTER TABLE tp_rating_plans DROP timing_type, DROP time_in, DROP monday, DROP tuesday, DROP wednesday, DROP thursday, DROP friday, DROP saturday, DROP sunday, CHANGE destinationrategroupid destinationRateId INT UNSIGNED NOT NULL');
        $this->addSql('CREATE INDEX IDX_4CC2BCAB4EB67480 ON tp_rating_plans (destinationRateId)');
    }
}
