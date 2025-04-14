<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250414130820 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Remove unique index for callid and direction on cdr tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX provider_usersCdr_callid_direction ON UsersCdrs');
        $this->addSql('DROP INDEX trunksCdr_callid_direction ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX usersCdr_callid_direction ON kam_users_cdrs');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX provider_usersCdr_callid_direction ON UsersCdrs (callid, direction)');
        $this->addSql('CREATE UNIQUE INDEX trunksCdr_callid_direction ON kam_trunks_cdrs (callid, direction)');
        $this->addSql('CREATE UNIQUE INDEX usersCdr_callid_direction ON kam_users_cdrs (callid, direction)');
    }
}