<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200309102734 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers ADD userId INT UNSIGNED DEFAULT NULL, ADD faxId INT UNSIGNED DEFAULT NULL, ADD friendId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E64B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E624C8D73 FOREIGN KEY (faxId) REFERENCES Faxes (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E893BA339 FOREIGN KEY (friendId) REFERENCES Friends (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_100E171E64B64DCC ON CallCsvSchedulers (userId)');
        $this->addSql('CREATE INDEX IDX_100E171E624C8D73 ON CallCsvSchedulers (faxId)');
        $this->addSql('CREATE INDEX IDX_100E171E893BA339 ON CallCsvSchedulers (friendId)');

        $this->addSql(
            'UPDATE PublicEntities SET brand = 1 WHERE iden IN ("Faxes", "Users")'
        );

        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.brandId IS NOT NULL AND A.companyId IS NULL AND P.iden in ("Faxes", "Users") and P.brand = 1'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers DROP FOREIGN KEY FK_100E171E64B64DCC');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP FOREIGN KEY FK_100E171E624C8D73');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP FOREIGN KEY FK_100E171E893BA339');
        $this->addSql('DROP INDEX IDX_100E171E64B64DCC ON CallCsvSchedulers');
        $this->addSql('DROP INDEX IDX_100E171E624C8D73 ON CallCsvSchedulers');
        $this->addSql('DROP INDEX IDX_100E171E893BA339 ON CallCsvSchedulers');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP userId, DROP faxId, DROP friendId');

        $this->addSql(
            'UPDATE PublicEntities SET brand = 0 WHERE iden = "Faxes"'
        );

        $this->addSql(
            'DELETE FROM AdministratorRelPublicEntities WHERE '
            . 'administratorId IN (SELECT id from Administrators A WHERE A.brandId IS NOT NULL AND A.companyId IS NULL) AND '
            . 'publicEntityId IN (SELECT id FROM PublicEntities P WHERE P.iden in ("Faxes"))'
        );
    }
}
