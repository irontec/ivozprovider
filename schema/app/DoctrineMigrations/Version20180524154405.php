<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180524154405 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE RoutingTags (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, tag VARCHAR(15) NOT NULL, brandId INT UNSIGNED NOT NULL, INDEX IDX_109FBB419CBEC244 (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CompaniesRelRoutingTags (id INT UNSIGNED AUTO_INCREMENT NOT NULL, companyId INT UNSIGNED NOT NULL, routingTagId INT UNSIGNED NOT NULL, INDEX IDX_1CE5AE3C2480E723 (companyId), INDEX IDX_1CE5AE3CA48EA1F0 (routingTagId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE RoutingTags ADD CONSTRAINT FK_109FBB419CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CompaniesRelRoutingTags ADD CONSTRAINT FK_1CE5AE3C2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CompaniesRelRoutingTags ADD CONSTRAINT FK_1CE5AE3CA48EA1F0 FOREIGN KEY (routingTagId) REFERENCES RoutingTags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE OutgoingRouting ADD routingTagId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE OutgoingRouting ADD CONSTRAINT FK_56931472A48EA1F0 FOREIGN KEY (routingTagId) REFERENCES RoutingTags (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_56931472A48EA1F0 ON OutgoingRouting (routingTagId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE OutgoingRouting DROP FOREIGN KEY FK_56931472A48EA1F0');
        $this->addSql('ALTER TABLE CompaniesRelRoutingTags DROP FOREIGN KEY FK_1CE5AE3CA48EA1F0');
        $this->addSql('DROP TABLE RoutingTags');
        $this->addSql('DROP TABLE CompaniesRelRoutingTags');
        $this->addSql('DROP INDEX IDX_56931472A48EA1F0 ON OutgoingRouting');
        $this->addSql('ALTER TABLE OutgoingRouting DROP routingTagId');
    }
}
