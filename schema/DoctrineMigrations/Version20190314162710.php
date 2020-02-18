<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190314162710 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('RENAME TABLE BrandURLs TO WebPortals');
        $this->addSql('ALTER TABLE WebPortals DROP FOREIGN KEY FK_8DBE74F59CBEC244');
        $this->addSql('ALTER TABLE WebPortals CHANGE brandId brandId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE WebPortals ADD CONSTRAINT FK_C811E30C9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE WebPortals RENAME INDEX idx_8dbe74f59cbec244 TO IDX_C811E30C9CBEC244');
        $this->addSql('ALTER TABLE WebPortals RENAME INDEX url TO webportal_url');


    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE WebPortals RENAME INDEX webportal_url TO url');
        $this->addSql('ALTER TABLE WebPortals DROP FOREIGN KEY FK_C811E30C9CBEC244');
        $this->addSql('UPDATE WebPortals SET brandId = (SELECT MIN(id) from Brands) WHERE brandId IS NULL');
        $this->addSql('ALTER TABLE WebPortals CHANGE brandId brandId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE WebPortals ADD CONSTRAINT FK_8DBE74F59CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE WebPortals RENAME INDEX idx_c811e30c9cbec244 TO IDX_8DBE74F59CBEC244');
        $this->addSql('RENAME TABLE WebPortals TO BrandURLs');
    }
}
