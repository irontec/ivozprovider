<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20250307085857 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Fix PublicEntities fqdn';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            UPDATE PublicEntities 
            SET fqdn = SUBSTRING(fqdn, 2)
            WHERE fqdn LIKE \'\\\\\\%\'
        ');
    }

    public function down(Schema $schema): void
    {

    }
}