<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20241219160857 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Fix ApplicationServerSetRelApplicationServers';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('SET FOREIGN_KEY_CHECKS=0');

        $this->addSql('ALTER TABLE
          ApplicationServerSetRelApplicationServers
        CHANGE
          applicationServerId applicationServerId INT UNSIGNED NOT NULL,
        CHANGE
          applicationServerSetId applicationServerSetId INT UNSIGNED NOT NULL');

        $this->addSql('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE
          ApplicationServerSetRelApplicationServers
        CHANGE
          applicationServerId applicationServerId INT UNSIGNED DEFAULT NULL,
        CHANGE
          applicationServerSetId applicationServerSetId INT UNSIGNED DEFAULT NULL');
    }
}