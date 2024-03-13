<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240308080459 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Fix typo on UsersCdrs fqdn';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
        'UPDATE `PublicEntities` 
            SET fqdn="Ivoz\\\\Provider\\\\Domain\\\\Model\\\\UsersCdr\\\\UsersCdr"
            WHERE iden="UsersCdrs"'
        );
    }

    public function down(Schema $schema): void
    {
    }
}
