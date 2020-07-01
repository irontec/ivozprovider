<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200701093454 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE PublicEntities SET client = 1 WHERE iden = "_ActiveCalls"');

        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NOT NULL AND A.companyId IS NOT NULL AND P.iden in ("_ActiveCalls") and P.client = 1'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE PublicEntities SET client = 0 WHERE iden = "_ActiveCalls"');

        $this->addSql(
            'DELETE FROM AdministratorRelPublicEntities WHERE '
            . 'administratorId IN (SELECT id from Administrators A WHERE A.brandId IS NOT NULL AND A.companyId IS NOT NULL) AND '
            . 'publicEntityId IN (SELECT id FROM PublicEntities P WHERE P.iden in ("_ActiveCalls"))'
        );
    }
}
