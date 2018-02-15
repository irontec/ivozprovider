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
        $this->addSql('INSERT INTO tp_account_actions (tenant, account, companyId) SELECT CONCAT("b", brandId), CONCAT("c", id), id FROM Companies');

        // Timings
        $this->addSql('INSERT INTO tp_timings (id, tag, years, months, month_days, week_days) VALUES (1, "ALWAYS", "*any", "*any", "*any", "*any")');

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
        $this->addSql('INSERT INTO RatingPlans (id, tag, name_en, name_es, description_es, description_en, brandId) SELECT C.id, CONCAT("b", C.brandId, "rp", C.id), LEFT(CONCAT("Plan for ", C.name), 55), LEFT(CONCAT("Plan for ", C.name), 55), CONCAT("Imported from ", C.name), CONCAT("Imported from ", C.name), C.brandId FROM Companies C WHERE id IN (SELECT DISTINCT(companyId) FROM PricingPlansRelCompanies)');
        $this->addSql('INSERT INTO tp_rating_plans (id, tag, destrates_tag, timing_tag, weight, timingId, ratingPlanId, destinationRateId) SELECT PPRC.id, RP.tag, DR.tag, "ALWAYS", metric, 1, RP.id, DR.id FROM PricingPlansRelCompanies PPRC INNER JOIN DestinationRates DR ON DR.id = PPRC.pricingPlanId INNER JOIN RatingPlans RP ON RP.id = PPRC.companyId WHERE PPRC.validFrom < NOW() AND PPRC.validTo > NOW()');

        // Rating Profiles
        $this->addSql('INSERT INTO tp_rating_profiles(id, tenant, subject, activation_time, rating_plan_tag, companyId, ratingPlanId) SELECT C.id, CONCAT("b", C.brandId), CONCAT("c", C.id), NOW(), RP.tag, C.id, RP.id FROM Companies C INNER JOIN RatingPlans RP ON RP.id = C.id');

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
