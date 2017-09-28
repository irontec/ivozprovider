<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170918160422 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE changelog');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE changelog (change_number BIGINT NOT NULL, delta_set VARCHAR(10) NOT NULL COLLATE utf8_general_ci, start_dt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, complete_dt DATETIME DEFAULT NULL, applied_by VARCHAR(100) NOT NULL COLLATE utf8_general_ci, description VARCHAR(500) NOT NULL COLLATE utf8_general_ci, PRIMARY KEY(change_number, delta_set)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }
}
