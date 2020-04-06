<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200324123710 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ProxyTrunksRelBrands (id INT UNSIGNED AUTO_INCREMENT NOT NULL, brandId INT UNSIGNED NOT NULL, proxyTrunkId INT UNSIGNED NOT NULL, INDEX IDX_3ECFAB9CBEC244 (brandId), UNIQUE INDEX proxyTrunkRelBrand_proxyTrunk_brand (proxyTrunkId, brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ProxyTrunksRelBrands ADD CONSTRAINT FK_3ECFAB9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ProxyTrunksRelBrands ADD CONSTRAINT FK_3ECFAB7504E30F FOREIGN KEY (proxyTrunkId) REFERENCES ProxyTrunks (id) ON DELETE CASCADE');

        $this->addSql('ALTER TABLE DDIProviders ADD proxyTrunkId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIProviders ADD CONSTRAINT FK_CA534EFD7504E30F FOREIGN KEY (proxyTrunkId) REFERENCES ProxyTrunks (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_CA534EFD7504E30F ON DDIProviders (proxyTrunkId)');
        $this->addSql('ALTER TABLE Carriers ADD proxyTrunkId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Carriers ADD CONSTRAINT FK_F63EC8E37504E30F FOREIGN KEY (proxyTrunkId) REFERENCES ProxyTrunks (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_F63EC8E37504E30F ON Carriers (proxyTrunkId)');

        // All existing brands can use main proxyTrunkId
        $this->addSql('INSERT INTO ProxyTrunksRelBrands (brandId, proxyTrunkId) SELECT id, 1 FROM Brands');

        // Update all carriers and ddi providers to main proxyTrunkId
        $this->addSql('UPDATE Carriers SET proxyTrunkId=1');
        $this->addSql('UPDATE DDIProviders SET proxyTrunkId=1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Carriers DROP FOREIGN KEY FK_F63EC8E37504E30F');
        $this->addSql('DROP INDEX IDX_F63EC8E37504E30F ON Carriers');
        $this->addSql('ALTER TABLE Carriers DROP proxyTrunkId');
        $this->addSql('ALTER TABLE DDIProviders DROP FOREIGN KEY FK_CA534EFD7504E30F');
        $this->addSql('DROP INDEX IDX_CA534EFD7504E30F ON DDIProviders');
        $this->addSql('ALTER TABLE DDIProviders DROP proxyTrunkId');

        $this->addSql('DROP TABLE ProxyTrunksRelBrands');
    }
}
