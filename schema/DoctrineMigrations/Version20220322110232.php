<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220322110232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new Locations table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Locations (
                          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                          name VARCHAR(50) NOT NULL,
                          description VARCHAR(500) DEFAULT NULL,
                          companyId INT UNSIGNED NOT NULL,
                      INDEX IDX_9517C8192480E723 (companyId),
                      PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Locations ADD CONSTRAINT FK_9517C8192480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');

        $this->addSql('ALTER TABLE Users ADD location INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Users ADD CONSTRAINT FK_D5428AED5E9E89CB FOREIGN KEY (location) REFERENCES Locations (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_D5428AED5E9E89CB ON Users (location)');

        // Add Administrator ACLs for Location entity
        $this->addSql("INSERT INTO PublicEntities
                (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it)
            VALUES
                ('Locations', 'Ivoz\Provider\Domain\Model\Location\Location', 0, 0, 1, 'Locations', 'Ubicaciones', 'Ubicacions', 'Ubicazioni')"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Users DROP FOREIGN KEY FK_D5428AED5E9E89CB');
        $this->addSql('DROP TABLE Locations');
        $this->addSql('DROP INDEX IDX_D5428AED5E9E89CB ON Users');
        $this->addSql('ALTER TABLE Users DROP location');
    }
}
