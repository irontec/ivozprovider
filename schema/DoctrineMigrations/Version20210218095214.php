<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20210218095214 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('set sql_mode = \'STRICT_TRANS_TABLES\'');
        $this->addSql('ALTER TABLE Companies CHANGE countryId countryId INT UNSIGNED NOT NULL');

        $this->addSql('ALTER TABLE DDIs CHANGE countryId countryId INT UNSIGNED DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Companies CHANGE countryId countryId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIs CHANGE countryId countryId INT UNSIGNED NOT NULL');
    }
}
