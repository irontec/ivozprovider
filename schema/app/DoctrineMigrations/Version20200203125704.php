<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200203125704 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `BrandServices` DROP INDEX `IDX_AA498CCC9CBEC244`');
        $this->addSql('ALTER TABLE `CallACL` DROP INDEX `IDX_D37348182480E723`');
        $this->addSql('ALTER TABLE `CallAclRelMatchLists` DROP INDEX `IDX_9BCB337648DE28A4`');
        $this->addSql('ALTER TABLE `CompanyServices` DROP INDEX `IDX_569B460B2480E723`');
        $this->addSql('ALTER TABLE `ConferenceRooms` DROP INDEX `IDX_7CE925992480E723`');
        $this->addSql('ALTER TABLE `DestinationRates` DROP INDEX `IDX_6CAE066FC11683D9`');
        $this->addSql('ALTER TABLE `Extensions` DROP INDEX `IDX_9AAD9F792480E723`');
        $this->addSql('ALTER TABLE `Faxes` DROP INDEX `IDX_196F4C1E2480E723`');
        $this->addSql('ALTER TABLE `FeaturesRelBrands` DROP INDEX `IDX_6BA10487397515B7`');
        $this->addSql('ALTER TABLE `FeaturesRelCompanies` DROP INDEX `IDX_2C2CF4D9397515B7`');
        $this->addSql('ALTER TABLE `FixedCosts` DROP INDEX `IDX_1D4E03F49CBEC244`');
        $this->addSql('ALTER TABLE `Friends` DROP INDEX `IDX_EE5349F52480E723`');
        $this->addSql('ALTER TABLE `HuntGroupsRelUsers` DROP INDEX `IDX_79ED31AB64B64DCC`');
        $this->addSql('ALTER TABLE `IVREntries` DROP INDEX `IDX_E847DD7C2045F052`');
        $this->addSql('ALTER TABLE `IVRExcludedExtensions` DROP INDEX `IDX_36E264F22045F052`');
        $this->addSql('ALTER TABLE `MatchLists` DROP INDEX `IDX_BAF072189CBEC244`');
        $this->addSql('ALTER TABLE `NotificationTemplatesContents` DROP INDEX `IDX_AD99291D1333F77D`');
        $this->addSql('ALTER TABLE `OutgoingDDIRules` DROP INDEX `IDX_C4795A7C2480E723`');
        $this->addSql('ALTER TABLE `OutgoingDDIRulesPatterns` DROP INDEX `IDX_A4399FB2FC6BB9C8`');
        $this->addSql('ALTER TABLE `OutgoingRoutingRelCarriers` DROP INDEX `IDX_BD8A311D3CDE892`');
        $this->addSql('ALTER TABLE `Queues` DROP INDEX `IDX_C86607A02480E723`');
        $this->addSql('ALTER TABLE `RatingPlans` DROP INDEX `IDX_EB67DB9C6A765F36`');
        $this->addSql('ALTER TABLE `RatingProfiles` DROP INDEX `IDX_282687BB2480E723`');
        $this->addSql('ALTER TABLE `RoutingPatternGroupsRelPatterns` DROP INDEX `IDX_C90A69B46D661974`');
        $this->addSql('ALTER TABLE `kam_users_cdrs` DROP INDEX `IDX_238F735B2480E723`');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }
}
