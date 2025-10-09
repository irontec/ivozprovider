<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250730070330 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Fix PublicEntities fqdn for Contacts';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'UPDATE `PublicEntities`
                SET fqdn="Ivoz\\\\Provider\\\\Domain\\\\Model\\\\Contact\\\\Contact"
                WHERE iden="Contacts"'
        );
    }

    public function down(Schema $schema): void
    {
    }
}