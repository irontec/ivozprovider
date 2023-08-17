<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230817114147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Persist PublicEntities and AdministratorRelPublicEntities in PublicEntities db table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'INSERT IGNORE INTO PublicEntities
                (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it)
            VALUES
                ("PublicEntities", "Ivoz\\\\Provider\\\\Domain\\\\Model\\\\PublicEntity\\\\PublicEntity", 1, 1, 0, "Entity", "Entidad", "Entidad", "Entity")'
        );

        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.companyId IS NULL AND P.iden = "PublicEntities"'
        );

        $this->addSql(
            'INSERT IGNORE INTO PublicEntities
                (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it)
            VALUES
                (
                    "AdministratorRelPublicEntities",
                    "Ivoz\\\\Provider\\\\Domain\\\\Model\\\\AdministratorRelPublicEntity\\\\AdministratorRelPublicEntity",
                    1, 1, 0,
                    "Administrator <-> Entity", "Administrador <-> Entidad", "Administrador <-> Entidad", "Administrator <-> Entity")'
        );

        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.companyId IS NULL AND P.iden = "AdministratorRelPublicEntity"'
        );

        // Fixed previous migration fqdns
        $this->addSql(
            'UPDATE PublicEntities SET fqdn = "Ivoz\\\\Provider\\\\Domain\\\\Model\\\\BalanceMovement\\\\BalanceMovement" where iden = "BalanceMovements"'
        );

        $this->addSql(
            'UPDATE PublicEntities SET fqdn = "Ivoz\\\\Kam\\\\Domain\\\\Model\\\\Trusted\\\\Trusted" where iden = "kam_trusted"'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'DELETE FROM PublicEntities WHERE iden in ("PublicEntities", "AdministratorRelPublicEntities")'
        );
    }
}
