<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20210204104125 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends ADD multiContact TINYINT(1) UNSIGNED DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD multiContact TINYINT(1) UNSIGNED DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE ResidentialDevices ADD multiContact TINYINT(1) UNSIGNED DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE Users ADD multiContact TINYINT(1) UNSIGNED DEFAULT \'1\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends DROP multiContact');
        $this->addSql('ALTER TABLE ResidentialDevices DROP multiContact');
        $this->addSql('ALTER TABLE RetailAccounts DROP multiContact');
        $this->addSql('ALTER TABLE Users DROP multiContact');
    }
}
