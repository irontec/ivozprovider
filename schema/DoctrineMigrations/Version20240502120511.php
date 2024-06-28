<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240502120511 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add proxyuser to Residential and Retail';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ResidentialDevices ADD proxyUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE ResidentialDevices ADD CONSTRAINT FK_1805369A305E0E4B FOREIGN KEY (proxyUserId) REFERENCES ProxyUsers (id) ON DELETE SET NULL ON UPDATE RESTRICT');
        $this->addSql('CREATE INDEX IDX_1805369A305E0E4B ON ResidentialDevices (proxyUserId)');
        $this->addSql('ALTER TABLE RetailAccounts ADD proxyUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D9250305E0E4B FOREIGN KEY (proxyUserId) REFERENCES ProxyUsers (id) ON DELETE SET NULL ON UPDATE RESTRICT');
        $this->addSql('CREATE INDEX IDX_732D9250305E0E4B ON RetailAccounts (proxyUserId)');

        $this->addSql('UPDATE ResidentialDevices SET proxyUserId = (SELECT max(id) FROM ProxyUsers) WHERE directConnectivity = "yes"');
        $this->addSql('UPDATE RetailAccounts SET proxyUserId = (SELECT max(id) FROM ProxyUsers) WHERE directConnectivity = "yes"');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ResidentialDevices DROP FOREIGN KEY FK_1805369A305E0E4B');
        $this->addSql('DROP INDEX IDX_1805369A305E0E4B ON ResidentialDevices');
        $this->addSql('ALTER TABLE ResidentialDevices DROP proxyUserId');
        $this->addSql('ALTER TABLE RetailAccounts DROP FOREIGN KEY FK_732D9250305E0E4B');
        $this->addSql('DROP INDEX IDX_732D9250305E0E4B ON RetailAccounts');
        $this->addSql('ALTER TABLE RetailAccounts DROP proxyUserId');
    }
}
