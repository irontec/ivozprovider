<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240315103713 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add HolidayDateRange ACLs';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'INSERT INTO PublicEntities(`iden`, `fqdn`, `client`, `name_en`, `name_es`, `name_ca`, `name_it`)'
                .'VALUES("HolidayDateRange", "Ivoz\\\\Provider\\\\Domain\\\\Model\\\\HolidayDate\\\\HolidayDateRange", 1,'
                        .'"Holiday date ranges", "Rango de festivos", "Rang de festius", "Intervalli festivi")'
        );

        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (`administratorId`, `publicEntityId`, `read`) '
            . 'SELECT A.id, P.id, 1 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE P.iden = "HolidayDateRange" AND A.restricted = 1 AND A.brandId IS NOT NULL AND A.companyId IS NOT NULL'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM PublicEntities WHERE `iden` = "HolidayDateRange"');
    }
}
