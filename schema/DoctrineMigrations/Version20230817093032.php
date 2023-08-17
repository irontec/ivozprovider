<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230817093032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update brand public entities';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('UPDATE PublicEntities SET brand = 1 WHERE iden = "MusicOnHold"');
        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NOT NULL AND A.companyId IS NULL AND P.iden = "MusicOnHold"'
        );

        $this->addSql('UPDATE PublicEntities SET brand = 1 WHERE iden = "MatchLists"');
        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NOT NULL AND A.companyId IS NULL AND P.iden = "MatchLists"'
        );

        $this->addSql('UPDATE PublicEntities SET brand = 1 WHERE iden = "MatchListPatterns"');
        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NOT NULL AND A.companyId IS NULL AND P.iden = "MatchListPatterns"'
        );

        // Add new Public entity data
        $this->addSql(
            'INSERT INTO PublicEntities
                (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it)
            VALUES
                ("BalanceMovements", "Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement", 0, 1, 0, "Balance Movement", "Ingresos", "Moviment de balanç", "Movimenti Saldo")'
        );

        $this->addSql(
            'INSERT INTO PublicEntities
                (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it)
            VALUES
                ("kam_trusted", "Ivoz\Kam\Domain\Model\Trusted\Trusted", 0, 1, 0, "Trusted", "Confiable", "Confiable", "Affidabile")'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
