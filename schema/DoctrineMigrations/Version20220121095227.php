<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20220121095227 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP VIEW ast_musiconhold');
        $this->addSql('CREATE VIEW ast_musiconhold AS SELECT CONCAT("brand", brandId) as name, "files" as mode, CONCAT("moh/custom/brand", brandId) AS directory, "random" AS sort FROM MusicOnHold WHERE brandId IS NOT NULL GROUP BY brandId UNION SELECT CONCAT("company", companyId) as name, "files" as mode, CONCAT("moh/custom/company", companyId) AS directory, "random" AS sort FROM MusicOnHold WHERE companyId IS NOT NULL GROUP BY companyId');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP VIEW ast_musiconhold');
        $this->addSql('CREATE VIEW ast_musiconhold AS SELECT CONCAT("brand", brandId) as name, "files" as mode, CONCAT("moh/custom/brand", brandId) AS directory FROM MusicOnHold WHERE brandId IS NOT NULL GROUP BY brandId UNION SELECT CONCAT("company", companyId) as name, "files" as mode, CONCAT("moh/custom/company", companyId) AS directory FROM MusicOnHold WHERE companyId IS NOT NULL GROUP BY companyId');
    }
}
