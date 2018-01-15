<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180115125057 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Account Actions
        $this->addSql('INSERT INTO tp_account_actions (tenant, account, companyId) SELECT CONCAT("b", brandId), CONCAT("c", id), id FROM Companies;');

        // Timings
        $this->addSql('INSERT INTO tp_timings (tag, years, months, month_days, week_days) VALUES ("ALWAYS", "*any", "*any", "*any", "*any")');

        // Destinations
        $this->addSql('INSERT INTO Destinations (id, tag, name_en, name_es, description_en, description_es, brandId) SELECT id, CONCAT("b", brandId, "dst", id), name_en, name_es, description_en, description_es, brandId FROM TargetPatterns');
        $this->addSql('INSERT INTO tp_destinations (id, tag, prefix, destinationId) SELECT D.id, D.tag, TP.regExp, D.id FROM TargetPatterns TP INNER JOIN Destinations D ON TP.id = D.id');

        // Rates
        $this->addSql('INSERT INTO Rates (id, tag, name, brandId)
                            SELECT PPRTP.id, CONCAT("b", PP.brandId, "rt", PPRTP.id), CONCAT(TP.name_en, " (", PP.name_en, ")"), PP.brandId
                                FROM PricingPlansRelTargetPatterns PPRTP
                                INNER JOIN PricingPlans PP ON PP.id = PPRTP.pricingPlanId
                                INNER JOIN TargetPatterns TP ON TP.id = PPRTP.targetPatternId');
        $this->addSql('INSERT INTO tp_rates (id, tag, connect_fee, rate, rate_increment, rateId)
                            SELECT PPRTP.id, R.tag, PPRTP.connectionCharge, PPRTP.perPeriodCharge, CONCAT(PPRTP.periodTime, "s"), R.id 
                              FROM PricingPlansRelTargetPatterns PPRTP
                              INNER JOIN Rates R ON R.id = PPRTP.id');

        // Destinations Rates
        $this->addSql('INSERT INTO DestinationRates (id, tag, name_en, name_es, description_en, description_es, brandId) SELECT id, CONCAT("b", brandId, "dr", id), name_en, name_es, description_en, description_es, brandId FROM PricingPlans');
        $this->addSql('INSERT INTO tp_destination_rates (tag, destinations_tag, rates_tag, destinationRateId, destinationId, rateId)
                            SELECT DR.tag, D.tag, R.tag, DR.id, D.id, R.id
                              FROM PricingPlansRelTargetPatterns PPRTP
                              INNER JOIN DestinationRates DR ON DR.id = PPRTP.pricingPlanId
                              INNER JOIN Destinations D ON D.id = PPRTP.targetPatternId
                              INNER JOIN Rates R ON R.id = PPRTP.id');

        // Rating Plans
        $this->addSql('INSERT INTO RatingPlans (id, tag, name_en, name_es, description_en, description_es, destinationRateId, brandId) SELECT id, CONCAT("b", brandId, "rp", id), name_en, name_es, description_en, description_es, id, brandId FROM DestinationRates');
        $this->addSql('INSERT INTO tp_rating_plans (id, tag, destrates_tag, timing_tag, timingId, ratingPlanId, destinationRateId) SELECT DR.id, RP.tag, DR.tag, "ALWAYS", 1, RP.id, DR.id FROM RatingPlans RP INNER JOIN DestinationRates DR ON DR.id = RP.destinationRateId');

        // Rating Profiles
        $this->addSql('INSERT INTO tp_rating_profiles (tenant, subject, rating_plan_tag, activation_time, companyId, ratingPlanId) SELECT CONCAT("b", C.brandId), CONCAT("c", C.id) , RP.tag, PPRC.validFrom, C.id, RP.id FROM PricingPlansRelCompanies PPRC INNER JOIN Companies C ON C.id = PPRC.companyId INNER JOIN RatingPlans RP ON RP.id = PPRC.pricingPlanId');

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
