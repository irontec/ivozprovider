<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20261119090000 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Index UsersCdrs by callid and direction';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE INDEX provider_usersCdr_callid_direction ON UsersCdrs (callid, direction)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX provider_usersCdr_callid_direction ON UsersCdrs');
    }
}
