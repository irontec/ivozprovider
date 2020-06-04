<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200604125512 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DestinationRateGroups ADD deductibleConnectionFee TINYINT(1) unsigned DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE tp_destination_rates CHANGE rounding_method rounding_method VARCHAR(255) DEFAULT \'*up\' NOT NULL COMMENT \'[enum:*up|*upmincost]\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DestinationRateGroups DROP deductibleConnectionFee');
        $this->addSql('ALTER TABLE tp_destination_rates CHANGE rounding_method rounding_method VARCHAR(255) DEFAULT \'*up\' NOT NULL COLLATE utf8_general_ci');
    }
}
