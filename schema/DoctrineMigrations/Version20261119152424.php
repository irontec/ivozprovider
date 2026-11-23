<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20261119152424 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Index refresh_tokens by username to revoke user sessions';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE INDEX refreshToken_username ON refresh_tokens (username)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX refreshToken_username ON refresh_tokens');
    }
}
