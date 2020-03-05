<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200305163752 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE BannedAddresses (id INT UNSIGNED AUTO_INCREMENT NOT NULL, ip VARCHAR(50) DEFAULT NULL, blocker VARCHAR(50) DEFAULT NULL COMMENT \'[enum:antiflood|ipfilter]\', description VARCHAR(100) DEFAULT NULL, lastTimeBanned DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', brandId INT UNSIGNED DEFAULT NULL, companyId INT UNSIGNED DEFAULT NULL, INDEX IDX_63B7B3C79CBEC244 (brandId), INDEX IDX_63B7B3C72480E723 (companyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE BannedAddresses ADD CONSTRAINT FK_63B7B3C79CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE BannedAddresses ADD CONSTRAINT FK_63B7B3C72480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX bannedAddress_lastTimeBanned ON BannedAddresses (lastTimeBanned)');
        $this->addSql('CREATE INDEX bannedAddress_ip_blocker ON BannedAddresses (ip, blocker)');

        // Add to PublicEntities
        $this->addSql("INSERT INTO PublicEntities (iden, fqdn, platform, brand, client, name_en, name_es, name_ca, name_it) VALUES ('BannedAddresses', 'Ivoz\Provider\Domain\Model\BannedAddress\BannedAddress', 1, 1, 0, 'Banned Addresses', 'Direcciones bloqueadas', 'Direcciones bloqueadas', 'Banned Addresses')");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM PublicEntities WHERE iden='BannedAddresses'");

        $this->addSql('DROP TABLE BannedAddresses');
    }
}
