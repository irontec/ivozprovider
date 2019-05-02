<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180109153627 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE LcrRuleTargets RENAME INDEX lcr_id TO lcrRuleTarget_lcr_id');
        $this->addSql('ALTER TABLE Commandlog RENAME INDEX createdon TO commandlog_createdOn');
        $this->addSql('ALTER TABLE LcrRules RENAME INDEX lcr_id TO lcrRule_lcr_id');
        $this->addSql('ALTER TABLE Changelog RENAME INDEX createdon TO changelog_createdOn');
        $this->addSql('ALTER TABLE LcrGateways RENAME INDEX lcr_id TO lcrGateway_lcr_id');
        $this->addSql('ALTER TABLE kam_users_address RENAME INDEX companyid TO usersAddress_companyId');
        $this->addSql('ALTER TABLE kam_trunks_uacreg RENAME INDEX brandid TO trunksUacreg_brandId');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Changelog RENAME INDEX changelog_createdon TO createdOn');
        $this->addSql('ALTER TABLE Commandlog RENAME INDEX commandlog_createdon TO createdOn');
        $this->addSql('ALTER TABLE LcrGateways RENAME INDEX lcrgateway_lcr_id TO lcr_id');
        $this->addSql('ALTER TABLE LcrRuleTargets RENAME INDEX lcrruletarget_lcr_id TO lcr_id');
        $this->addSql('ALTER TABLE LcrRules RENAME INDEX lcrrule_lcr_id TO lcr_id');
        $this->addSql('ALTER TABLE kam_trunks_uacreg RENAME INDEX trunksuacreg_brandid TO brandId');
    }
}
