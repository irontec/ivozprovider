<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180919144526 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX ratingPlan_ratingPlanGroup_weight ON RatingPlans (ratingPlanGroupId, weight)');
        $this->addSql('DROP INDEX tpid_rplid_destrates_timings_weight ON tp_rating_plans');
        $this->addSql('CREATE UNIQUE INDEX tpid_rplid_destrates_timings_weight ON tp_rating_plans (tpid, tag, destrates_tag, timing_tag, weight)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX ratingPlan_ratingPlanGroup_weight ON RatingPlans');
        $this->addSql('DROP INDEX tpid_rplid_destrates_timings_weight ON tp_rating_plans');
        $this->addSql('CREATE UNIQUE INDEX tpid_rplid_destrates_timings_weight ON tp_rating_plans (tpid, tag, destrates_tag, timing_tag)');
    }
}
