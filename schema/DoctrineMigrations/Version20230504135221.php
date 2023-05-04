<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504135221 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'New Corporation entity and FK referenced on Companies';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Corporations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, brandId INT UNSIGNED DEFAULT NULL, INDEX IDX_770AEC3F9CBEC244 (brandId), UNIQUE INDEX name_brandId (name, brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Corporations ADD CONSTRAINT FK_770AEC3F9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Companies ADD corporationId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B52899B81BF891 FOREIGN KEY (corporationId) REFERENCES Corporations (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B52899B81BF891 ON Companies (corporationId)');

        // Create a Corporation for each existing VPBX Company
        $this->addSql('INSERT INTO Corporations (id, name, brandId) SELECT id, CONCAT("Corporation ", id), brandId FROM Companies WHERE type = "vpbx"');
        // Update Companies with the smallest Corporation id
        $this->addSql('UPDATE Companies C SET corporationId = (SELECT MIN(LEAST(companyId, interCompanyId)) AS corporationId FROM Friends WHERE directConnectivity = "intervpbx" AND (companyId = C.id OR interCompanyId = C.id))');
        // Delete Unused corporations
        $this->addSql('DELETE FROM Corporations WHERE id NOT IN (SELECT corporationId FROM Companies WHERE corporationId IS NOT NULL)');

        // Add new Public entity data
        $this->addSql("INSERT INTO PublicEntities 
                (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it)
            VALUES
                ('Corporations', 'Ivoz\\\\Provider\\\\Domain\\\\Model\\\\Corporation\\\\Corporation', 0, 1, 0, 'Corporations', 'Corporatciones', 'Corporacions', 'Corporazioni')"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899B81BF891');
        $this->addSql('DROP TABLE Corporations');
        $this->addSql('DROP INDEX IDX_B52899B81BF891 ON Companies');
        $this->addSql('ALTER TABLE Companies DROP corporationId');
    }
}
