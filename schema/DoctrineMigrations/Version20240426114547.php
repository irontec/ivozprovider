<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240426114547 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add fields ruri_domain to Friends, ResidentialDevices and RetailAccounts';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Friends ADD ruri_domain VARCHAR(190) DEFAULT NULL');
        $this->addSql('ALTER TABLE ResidentialDevices ADD ruri_domain VARCHAR(190) DEFAULT NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD ruri_domain VARCHAR(190) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Friends DROP ruri_domain');
        $this->addSql('ALTER TABLE ResidentialDevices DROP ruri_domain');
        $this->addSql('ALTER TABLE RetailAccounts DROP ruri_domain');
    }
}