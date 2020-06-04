<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200603095357 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            "INSERT INTO PublicEntities (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it) "
            . "VALUES ('_RegistrationSummary', 'Model\\\\RegistrationSummary', 0, 1, 1, 'Registration summary', 'Resumen de registros', 'Resumen de registros', 'Registration summary')"
        );

        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NOT NULL AND A.companyId IS NULL AND P.iden in ("_RegistrationSummary") and P.brand = 1'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(
            "DELETE FROM PublicEntities WHERE iden = '_RegistrationSummary'"
        );
    }
}
