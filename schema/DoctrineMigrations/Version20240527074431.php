<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240527074431 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added proxyUser to Friends';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Friends ADD proxyUserId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Friends ADD CONSTRAINT FK_EE5349F5305E0E4B FOREIGN KEY (proxyUserId) REFERENCES ProxyUsers (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_EE5349F5305E0E4B ON Friends (proxyUserId)');

        $this->addSql('UPDATE Friends SET proxyUserId = (SELECT max(id) FROM ProxyUsers) WHERE directConnectivity = "yes"');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Friends DROP FOREIGN KEY FK_EE5349F5305E0E4B');
        $this->addSql('DROP INDEX IDX_EE5349F5305E0E4B ON Friends');
        $this->addSql('ALTER TABLE Friends DROP proxyUserId');
    }
}
