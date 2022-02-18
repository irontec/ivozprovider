<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20220217170946 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Create new table Locations
        $this->addSql('CREATE TABLE Locations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(500) DEFAULT NULL, companyId INT UNSIGNED NOT NULL, INDEX IDX_9517C8192480E723 (companyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Locations ADD CONSTRAINT FK_9517C8192480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');

        // Add Users location field
        $this->addSql('ALTER TABLE Users ADD locationId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Users ADD CONSTRAINT FK_D5428AED96D7286D FOREIGN KEY (locationId) REFERENCES Locations (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_D5428AED96D7286D ON Users (locationId)');

        // Add Administrator ACLs for Location entity
        $this->addSql("INSERT INTO PublicEntities (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it) VALUES ('Locations', 'Ivoz\Provider\Domain\Model\Location\Location', 0, 0, 1, 'Locations', 'Ubicaciones', 'Ubicacions', 'Ubicazioni')");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Users DROP FOREIGN KEY FK_D5428AED96D7286D');
        $this->addSql('DROP TABLE Locations');
        $this->addSql('DROP INDEX IDX_D5428AED96D7286D ON Users');
        $this->addSql('ALTER TABLE Users DROP locationId');
        $this->addSql("DELETE FROM PublicEntities WHERE iden='Locations'");
    }
}
