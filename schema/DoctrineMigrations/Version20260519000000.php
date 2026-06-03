<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20260519000000 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Remove Webhooks feature from client level';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("UPDATE PublicEntities SET client = 0 WHERE iden = 'Webhooks'");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("UPDATE PublicEntities SET client = 1 WHERE iden = 'Webhooks'");
    }
}
