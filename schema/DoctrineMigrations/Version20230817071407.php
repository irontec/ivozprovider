<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230817071407 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Update platform public entities';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('UPDATE PublicEntities SET platform = 1 WHERE iden = "Currencies"');
        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NULL AND P.iden = "Currencies"'
        );

        $this->addSql('UPDATE PublicEntities SET platform = 1 WHERE iden = "NotificationTemplates"');
        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NULL AND P.iden = "NotificationTemplates"'
        );

        $this->addSql('UPDATE PublicEntities SET platform = 1 WHERE iden = "NotificationTemplateContents"');
        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NULL AND P.iden = "NotificationTemplateContents"'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
