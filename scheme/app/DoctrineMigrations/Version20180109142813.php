<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180109142813 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE HuntGroups ADD numberCountryId INT UNSIGNED DEFAULT NULL AFTER noAnswerTargetType');
        $this->addSql('ALTER TABLE HuntGroups ADD CONSTRAINT FK_4F9672ECD7819488 FOREIGN KEY (numberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_4F9672ECD7819488 ON HuntGroups (numberCountryId)');
        $this->addSql('UPDATE HuntGroups SET numberCountryId = (SELECT countryId FROM Companies WHERE Companies.id = HuntGroups.companyId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE HuntGroups DROP FOREIGN KEY FK_4F9672ECD7819488');
        $this->addSql('DROP INDEX IDX_4F9672ECD7819488 ON HuntGroups');
        $this->addSql('ALTER TABLE HuntGroups DROP numberCountryId');

    }
}
