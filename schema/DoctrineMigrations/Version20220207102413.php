<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20220207102413 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Create startTime index in kam_users_cdrs table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE INDEX usersCdr_startTime ON kam_users_cdrs (start_time)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX usersCdr_startTime ON kam_users_cdrs');
    }
}
