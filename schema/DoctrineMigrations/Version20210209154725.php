<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20210209154725 extends LoggableMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            "INSERT INTO PublicEntities (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it) "
            . "VALUES ('_UsersMassImport', 'Model\\\\UsersMassImport', 0, 1, 0, 'Users mass import', 'Importación masiva de usuarios', 'Importació massiva d\'usuaris', 'Importazione di massa degli utenti')"
        );

        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 0, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NOT NULL AND A.companyId IS NULL AND P.iden in ("_UsersMassImport") AND P.brand = 1'
        );
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(
            "DELETE FROM PublicEntities WHERE iden = '_UsersMassImport'"
        );
    }
}
