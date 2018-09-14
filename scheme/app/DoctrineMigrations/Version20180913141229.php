<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180913141229 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE tp_destinations TD INNER JOIN Destinations D ON TD.destinationId = D.id SET tpid = CONCAT(\'b\', D.brandId)');
        $this->addSql('UPDATE tp_rates TR INNER JOIN DestinationRates DR ON DR.id = TR.destinationRateId INNER JOIN DestinationRateGroups DRG ON DRG.id = DR.destinationRateGroupId SET tpid = CONCAT(\'b\', DRG.brandId)');
        $this->addSql('UPDATE tp_destination_rates TDR INNER JOIN DestinationRates DR ON DR.id = TDR.destinationRateId INNER JOIN DestinationRateGroups DRG ON DRG.id = DR.destinationRateGroupId SET tpid = CONCAT(\'b\', DRG.brandId)');
        $this->addSql('UPDATE tp_rating_plans TRP INNER JOIN RatingPlans RP ON RP.id = TRP.ratingPlanId SET tpid = CONCAT(\'b\', RP.brandId)');
        $this->addSql('UPDATE tp_lcr_rules SET tpid = tenant');
        $this->addSql('UPDATE tp_rating_profiles SET tpid = tenant');
        $this->addSql('UPDATE tp_account_actions SET tpid = tenant');
        $this->addSql('UPDATE tp_derived_chargers SET tpid = tenant');
        $this->addSql('UPDATE tp_cdr_stats TCS INNER JOIN Carriers C ON C.id = TCS.carrierId SET tpid = CONCAT(\'b\', C.brandId)');
        $this->addSql('UPDATE tp_timings SET tpid = LEFT(tag,2)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('UPDATE tp_destinations SET tpid = "ivozprovider"');
        $this->addSql('UPDATE tp_rates SET tpid = "ivozprovider"');
        $this->addSql('UPDATE tp_destination_rates SET tpid = "ivozprovider"');
        $this->addSql('UPDATE tp_rating_plans SET tpid = "ivozprovider"');
        $this->addSql('UPDATE tp_lcr_rules SET tpid = "ivozprovider"');
        $this->addSql('UPDATE tp_rating_profiles SET tpid = "ivozprovider"');
        $this->addSql('UPDATE tp_account_actions SET tpid = "ivozprovider"');
        $this->addSql('UPDATE tp_derived_chargers SET tpid = "ivozprovider"');
        $this->addSql('UPDATE tp_cdr_stats SET tpid = "ivozprovider"');
        $this->addSql('UPDATE tp_timings SET tpid = "ivozprovider"');
    }
}
