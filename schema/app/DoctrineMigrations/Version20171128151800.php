<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171128151800 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE kam_users_domain_attrs');
        $this->addSql("CREATE VIEW kam_users_domain_attrs AS SELECT cast(id as char) as did, 'brandId' as name, 0 as type, cast(brandId as char) as value FROM Domains D INNER JOIN (SELECT domainId, id AS brandId FROM Brands UNION SELECT domainId, brandId FROM Companies) BCD ON D.id = BCD.domainId WHERE domainId IS NOT NULL");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP VIEW kam_users_domain_attrs');
        $this->addSql('CREATE TABLE kam_users_domain_attrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, did VARCHAR(190) NOT NULL COLLATE utf8_general_ci, name VARCHAR(32) NOT NULL COLLATE utf8_general_ci, type INT UNSIGNED NOT NULL, value VARCHAR(255) NOT NULL COLLATE utf8_general_ci, last_modified DATETIME DEFAULT \'1900-01-01 00:00:01\' NOT NULL COMMENT \'(DC2Type:datetime)\', UNIQUE INDEX domain_attrs_idx (did, name, value), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }
}
