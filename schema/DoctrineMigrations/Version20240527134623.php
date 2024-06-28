<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240527134623 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add trustSDP field to Friends ResidentialDevices and ResidentialAccounts';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Friends ADD trustSDP TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE ResidentialDevices ADD trustSDP TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD trustSDP TINYINT(1) DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Friends DROP trustSDP');
        $this->addSql('ALTER TABLE ResidentialDevices DROP trustSDP');
        $this->addSql('ALTER TABLE RetailAccounts DROP trustSDP');
    }
}