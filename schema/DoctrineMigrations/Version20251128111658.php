<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20251128111658 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Update Users with empty name or lastName to use dot (.)';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("UPDATE Users SET lastName='.' WHERE lastName=''");
        $this->addSql("UPDATE Users SET name='.' WHERE name=''");
    }

    public function down(Schema $schema): void
    {
    }
}
