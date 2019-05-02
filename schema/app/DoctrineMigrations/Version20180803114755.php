<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180803114755 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Create CGRateS stable
        $this->addSql('CREATE TABLE tp_cdr_stats (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL, tag VARCHAR(64) NOT NULL, queue_length INT DEFAULT 0 NOT NULL, time_window VARCHAR(8) DEFAULT \'\' NOT NULL, save_interval VARCHAR(8) DEFAULT \'\' NOT NULL, metrics VARCHAR(64) NOT NULL, setup_interval VARCHAR(64) DEFAULT \'\' NOT NULL, tors VARCHAR(64) DEFAULT \'\' NOT NULL, cdr_hosts VARCHAR(64) DEFAULT \'\' NOT NULL, cdr_sources VARCHAR(64) DEFAULT \'\' NOT NULL, req_types VARCHAR(64) DEFAULT \'\' NOT NULL, directions VARCHAR(8) DEFAULT \'\' NOT NULL, tenants VARCHAR(64) DEFAULT \'\' NOT NULL, categories VARCHAR(32) DEFAULT \'\' NOT NULL, accounts VARCHAR(32) DEFAULT \'\' NOT NULL, subjects VARCHAR(64) DEFAULT \'\' NOT NULL, destination_ids VARCHAR(64) DEFAULT \'\' NOT NULL, ppd_interval VARCHAR(64) DEFAULT \'\' NOT NULL, usage_interval VARCHAR(64) DEFAULT \'\' NOT NULL, suppliers VARCHAR(64) DEFAULT \'\' NOT NULL, disconnect_causes VARCHAR(64) DEFAULT \'\' NOT NULL, mediation_runids VARCHAR(64) DEFAULT \'\' NOT NULL, rated_accounts VARCHAR(32) DEFAULT \'\' NOT NULL, rated_subjects VARCHAR(64) DEFAULT \'\' NOT NULL, cost_interval VARCHAR(24) DEFAULT \'\' NOT NULL, action_triggers VARCHAR(64) DEFAULT \'\' NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', carrierId INT UNSIGNED NOT NULL, INDEX IDX_CCA10B656709B1C (carrierId), INDEX tpCdrStat_tpid (tpid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tp_cdr_stats ADD CONSTRAINT FK_CCA10B656709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE CASCADE');

        // Populate tables with existing carriers
        $this->addSql('UPDATE tp_rating_profiles SET cdr_stat_queue_ids=subject WHERE subject LIKE "cr%"');
        $this->addSql("INSERT INTO tp_cdr_stats (tag, metrics, subjects, carrierId) SELECT CONCAT('cr', id), 'ACD', CONCAT('cr', id), id FROM Carriers");
        $this->addSql("INSERT INTO tp_cdr_stats (tag, metrics, subjects, carrierId) SELECT CONCAT('cr', id), 'ASR', CONCAT('cr', id), id FROM Carriers");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE tp_rating_profiles SET cdr_stat_queue_ids=NULL');
        $this->addSql('ALTER TABLE tp_cdr_stats DROP FOREIGN KEY FK_CCA10B656709B1C');
        $this->addSql('DROP TABLE tp_cdr_stats');
    }
}
