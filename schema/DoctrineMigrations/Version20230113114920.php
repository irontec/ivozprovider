<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113114920 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add new business Contact table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Contacts (
                        id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                        companyId INT UNSIGNED NOT NULL,
                        name VARCHAR(100) NOT NULL,
                        lastname VARCHAR(100) DEFAULT NULL,
                        email VARCHAR(100) DEFAULT NULL,
                        workPhoneCountryId INT UNSIGNED DEFAULT NULL,
                        workPhone VARCHAR(20) DEFAULT NULL,
                        workPhoneE164 VARCHAR(25) DEFAULT NULL,
                        mobilePhoneCountryId INT UNSIGNED DEFAULT NULL,
                        mobilePhone VARCHAR(20) DEFAULT NULL,
                        mobilePhoneE164 VARCHAR(25) DEFAULT NULL,
                        otherPhone VARCHAR(25) DEFAULT NULL,
                        userId INT UNSIGNED DEFAULT NULL,
                        UNIQUE INDEX UNIQ_CA36772564B64DCC (userId),
                        INDEX IDX_CA3677252480E723 (companyId),
                        INDEX IDX_CA367725BD3D33B9 (workPhoneCountryId),
                        INDEX IDX_CA367725220EC78C (mobilePhoneCountryId),
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Contacts ADD CONSTRAINT FK_CA36772564B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Contacts ADD CONSTRAINT FK_CA3677252480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Contacts ADD CONSTRAINT FK_CA367725BD3D33B9 FOREIGN KEY (workPhoneCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Contacts ADD CONSTRAINT FK_CA367725220EC78C FOREIGN KEY (mobilePhoneCountryId) REFERENCES Countries (id) ON DELETE SET NULL');

        // Add existing users as contacts
        $this->addSql('INSERT INTO Contacts (companyId, userId, name, lastname, email, otherPhone)
                            SELECT U.companyId, U.id, U.name, U.lastname, U.email, E.number FROM Users U LEFT JOIN Extensions E ON E.id = U.extensionId'
        );

        // Add new Public entity data
        $this->addSql('INSERT INTO PublicEntities
                (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it)
            VALUES
                ("Contacts", "Ivoz\Provider\Domain\Model\Contact\Contact", 0, 0, 1, "Adressbook", "Agenda", "Agenda", "Adressbook")'
        );

        $this->addSql('INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.companyId IS NOT NULL AND P.iden = "Contacts"'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE Contacts');
        $this->addSql('DELETE FROM PublicEntities WHERE iden = "Contacts"');
    }
}
