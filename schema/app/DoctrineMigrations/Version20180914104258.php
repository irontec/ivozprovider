<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180914104258 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('RENAME TABLE RatingPlans TO RatingPlanGroups');
        $this->addSql('RENAME TABLE tp_rating_plans TO RatingPlans');
        $this->addSql('CREATE TABLE tp_rating_plans (
                                  id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                                  tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL,
                                  tag VARCHAR(64) DEFAULT NULL,
                                  destrates_tag VARCHAR(64) DEFAULT NULL,
                                  timing_tag VARCHAR(64) DEFAULT \'*any\' NOT NULL,
                                  weight NUMERIC(8, 2) DEFAULT \'10\' NOT NULL COMMENT \'(DC2Type:decimal)\',
                                  created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\',
                                  ratingPlanId INT UNSIGNED NOT NULL,
                          UNIQUE INDEX UNIQ_4CC2BCAB5C17F7F9 (ratingPlanId),
                          INDEX tpRatingPlan_tpid (tpid),
                          INDEX tpRatingPlan_tpid_rpl (tpid, tag),
                          UNIQUE INDEX tpid_rplid_destrates_timings_weight (tpid, tag, destrates_tag, timing_tag),
                          PRIMARY KEY(id))DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        $this->addSql('ALTER TABLE RatingPlans DROP FOREIGN KEY FK_4CC2BCAB5C17F7F9');
        $this->addSql('ALTER TABLE RatingPlans DROP FOREIGN KEY FK_4CC2BCAB8E5B4C15');

        $this->addSql('INSERT INTO tp_rating_plans (tpid, tag, destrates_tag, timing_tag, weight, created_at, ratingPlanId) 
                                SELECT tpid, tag, destrates_tag, timing_tag, weight, created_at, id FROM RatingPlans'
        );

        $this->addSql('ALTER TABLE tp_rating_plans ADD CONSTRAINT FK_4CC2BCAB5C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlans (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX tpid_rplid_destrates_timings_weight ON RatingPlans');
        $this->addSql('DROP INDEX IDX_4CC2BCAB8E5B4C15 ON RatingPlans');
        $this->addSql('DROP INDEX IDX_4CC2BCAB5C17F7F9 ON RatingPlans');
        $this->addSql('DROP INDEX tpRatingPlan_tpid ON RatingPlans');
        $this->addSql('DROP INDEX tpRatingPlan_tpid_rpl ON RatingPlans');

        $this->addSql('ALTER TABLE RatingPlans DROP tpid, DROP tag, DROP destrates_tag, DROP timing_tag, DROP created_at, CHANGE ratingplanid ratingPlanGroupId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE RatingPlans ADD CONSTRAINT FK_EB67DB9C6A765F36 FOREIGN KEY (ratingPlanGroupId) REFERENCES RatingPlanGroups (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EB67DB9C6A765F36 ON RatingPlans (ratingPlanGroupId)');
        $this->addSql('ALTER TABLE RatingPlans RENAME INDEX idx_4cc2bcabc11683d9 TO IDX_EB67DB9CC11683D9');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE BillableCalls DROP FOREIGN KEY FK_E6F2DA355C17F7F9');
        $this->addSql('DROP INDEX IDX_E6F2DA355C17F7F9 ON BillableCalls');
        $this->addSql('ALTER TABLE BillableCalls CHANGE ratingplanid ratingPlanGroupId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA356A765F36 FOREIGN KEY (ratingPlanGroupId) REFERENCES RatingPlanGroups (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_E6F2DA356A765F36 ON BillableCalls (ratingPlanGroupId)');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');

        $this->addSql('ALTER TABLE RatingProfiles DROP FOREIGN KEY FK_282687BB5C17F7F9');
        $this->addSql('DROP INDEX IDX_282687BB5C17F7F9 ON RatingProfiles');
        $this->addSql('DROP INDEX ratingProfile_company_plan_tag ON RatingProfiles');
        $this->addSql('ALTER TABLE RatingProfiles CHANGE ratingplanid ratingPlanGroupId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE RatingProfiles ADD CONSTRAINT FK_282687BB6A765F36 FOREIGN KEY (ratingPlanGroupId) REFERENCES RatingPlanGroups (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_282687BB6A765F36 ON RatingProfiles (ratingPlanGroupId)');
        $this->addSql('CREATE UNIQUE INDEX ratingProfile_company_plan_tag ON RatingProfiles (companyId, ratingPlanGroupId, routingTagId, activationTime)');
        $this->addSql('ALTER TABLE RatingPlanGroups RENAME INDEX idx_eb67db9c9cbec244 TO IDX_1826169C9CBEC244');
        $this->addSql('ALTER TABLE tp_timings ADD ratingPlanId INT UNSIGNED NOT NULL');

        $this->addSql('UPDATE tp_timings AS TT INNER JOIN RatingPlans AS RP ON RP.timingId = TT.id SET ratingPlanId = RP.id');
        $this->addSql('DELETE FROM tp_timings WHERE ratingPlanId = 0');
        $this->addSql('ALTER TABLE RatingPlans DROP timingId');

        $this->addSql('ALTER TABLE tp_timings ADD CONSTRAINT FK_D124F5385C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlans (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D124F5385C17F7F9 ON tp_timings (ratingPlanId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tp_rating_plans');
        $this->addSql('ALTER TABLE BillableCalls DROP FOREIGN KEY FK_E6F2DA356A765F36');
        $this->addSql('DROP INDEX IDX_E6F2DA356A765F36 ON BillableCalls');
        $this->addSql('ALTER TABLE BillableCalls CHANGE ratingplangroupid ratingPlanId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA355C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlanGroups (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_E6F2DA355C17F7F9 ON BillableCalls (ratingPlanId)');
        $this->addSql('ALTER TABLE RatingPlanGroups RENAME INDEX idx_1826169c9cbec244 TO IDX_EB67DB9C9CBEC244');
        $this->addSql('ALTER TABLE RatingPlans DROP FOREIGN KEY FK_EB67DB9C6A765F36');
        $this->addSql('DROP INDEX IDX_EB67DB9C6A765F36 ON RatingPlans');
        $this->addSql('ALTER TABLE RatingPlans ADD tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL COLLATE utf8_general_ci, ADD tag VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, ADD destrates_tag VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, ADD timing_tag VARCHAR(64) DEFAULT \'*any\' NOT NULL COLLATE utf8_general_ci, ADD created_at DATETIME DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL COMMENT \'(DC2Type:datetime)\', ADD timingId INT UNSIGNED DEFAULT NULL, CHANGE ratingplangroupid ratingPlanId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE RatingPlans ADD CONSTRAINT FK_4CC2BCAB5C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlanGroups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RatingPlans ADD CONSTRAINT FK_4CC2BCAB8E5B4C15 FOREIGN KEY (timingId) REFERENCES tp_timings (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX tpid_rplid_destrates_timings_weight ON RatingPlans (tpid, tag, destrates_tag, timing_tag)');
        $this->addSql('CREATE INDEX IDX_4CC2BCAB8E5B4C15 ON RatingPlans (timingId)');
        $this->addSql('CREATE INDEX IDX_4CC2BCAB5C17F7F9 ON RatingPlans (ratingPlanId)');
        $this->addSql('CREATE INDEX tpRatingPlan_tpid ON RatingPlans (tpid)');
        $this->addSql('CREATE INDEX tpRatingPlan_tpid_rpl ON RatingPlans (tpid, tag)');
        $this->addSql('ALTER TABLE RatingPlans RENAME INDEX idx_eb67db9cc11683d9 TO IDX_4CC2BCABC11683D9');
        $this->addSql('ALTER TABLE RatingProfiles DROP FOREIGN KEY FK_282687BB6A765F36');
        $this->addSql('DROP INDEX IDX_282687BB6A765F36 ON RatingProfiles');
        $this->addSql('DROP INDEX ratingProfile_company_plan_tag ON RatingProfiles');
        $this->addSql('ALTER TABLE RatingProfiles CHANGE ratingplangroupid ratingPlanId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE RatingProfiles ADD CONSTRAINT FK_282687BB5C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlanGroups (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_282687BB5C17F7F9 ON RatingProfiles (ratingPlanId)');
        $this->addSql('CREATE UNIQUE INDEX ratingProfile_company_plan_tag ON RatingProfiles (companyId, ratingPlanId, routingTagId, activationTime)');
        $this->addSql('ALTER TABLE tp_timings DROP FOREIGN KEY FK_D124F5385C17F7F9');
        $this->addSql('DROP INDEX UNIQ_D124F5385C17F7F9 ON tp_timings');
        $this->addSql('ALTER TABLE tp_timings DROP ratingPlanId');
        $this->addSql('RENAME TABLE RatingPlans TO tp_rating_plans');
        $this->addSql('RENAME TABLE RatingPlanGroups TO RatingPlans');
    }
}
