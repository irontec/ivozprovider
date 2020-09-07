<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200904135939 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends ADD rtpEncryption TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE Terminals ADD rtpEncryption TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD rtpEncryption TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE ResidentialDevices ADD rtpEncryption TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends DROP rtpEncryption');
        $this->addSql('ALTER TABLE ResidentialDevices DROP rtpEncryption');
        $this->addSql('ALTER TABLE RetailAccounts DROP rtpEncryption');
        $this->addSql('ALTER TABLE Terminals DROP rtpEncryption');
    }
}
