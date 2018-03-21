<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319174246 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sm_costs (id INT AUTO_INCREMENT NOT NULL, cgrid VARCHAR(40) NOT NULL, run_id VARCHAR(64) NOT NULL, origin_host VARCHAR(64) NOT NULL, origin_id VARCHAR(384) NOT NULL, cost_source VARCHAR(64) NOT NULL, `usage` BIGINT NOT NULL, cost_details TEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', UNIQUE INDEX costid (cgrid, run_id), INDEX origin_idx (origin_host, origin_id), INDEX run_origin_idx (run_id, origin_id), INDEX deleted_at_idx (deleted_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8  ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Companies ADD billingMethod VARCHAR(25) DEFAULT \'postpaid\' NOT NULL COMMENT \'[enum:postpaid|prepaid|pseudoprepaid]\'');
        $this->addSql('ALTER TABLE Companies ADD balance NUMERIC(10, 4) DEFAULT \'0\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sm_costs');
        $this->addSql('ALTER TABLE Companies DROP billingMethod');
        $this->addSql('ALTER TABLE Companies DROP balance');
    }
}
