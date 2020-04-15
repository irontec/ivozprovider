<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrand;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200414145121 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $iden = $this->connection->quote(
            'ProxyTrunksRelBrands'
        );
        $fqdn = $this->connection->quote(
            ProxyTrunksRelBrand::class
        );
        $nameEn = $this->connection->quote(
            'Proxy Trunks <-> Brand'
        );
        $nameEs = $this->connection->quote(
            'Proxy de Salida <-> Marca'
        );

        $insertQuery =
            'INSERT INTO `PublicEntities` (`iden`, `fqdn`, `platform`, `name_en`, `name_es`, `name_it`, `name_ca`)'
            . ' VALUES (%s, %s, 1, %s, %s, %s, %s)';

        $query = sprintf(
            $insertQuery,
            $iden,
            $fqdn,
            $nameEn,
            $nameEs,
            $nameEn,
            $nameEs
        );

        $this->addSql(
            $query
        );

        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.brandId IS NULL AND A.companyId IS NULL AND P.iden in ("ProxyTrunksRelBrands")'
        );

        $this->addSql(
            'UPDATE `PublicEntities` SET brand = 1 where iden = "ProxyTrunks"'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $iden = $this->connection->quote(
            'ProxyTrunksRelBrands'
        );

        $query = sprintf(
            'DELETE FROM `PublicEntities` WHERE `iden` = %s limit 1',
            $iden
        );

        $this->addSql($query);


        $this->addSql(
            'UPDATE `PublicEntities` SET brand = 0 where iden = "ProxyTrunks"'
        );
    }
}
