<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181105161633 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends ADD ddiIn VARCHAR(255) DEFAULT \'yes\' NOT NULL COMMENT \'[enum:yes|no]\'');
        $this->addSql('ALTER TABLE RetailAccounts ADD ddiIn VARCHAR(255) DEFAULT \'yes\' NOT NULL COMMENT \'[enum:yes|no]\'');
        $this->addSql('ALTER TABLE ResidentialDevices ADD ddiIn VARCHAR(255) DEFAULT \'yes\' NOT NULL COMMENT \'[enum:yes|no]\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends DROP ddiIn');
        $this->addSql('ALTER TABLE ResidentialDevices DROP ddiIn');
        $this->addSql('ALTER TABLE RetailAccounts DROP ddiIn');
    }
}
