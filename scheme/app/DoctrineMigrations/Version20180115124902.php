<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180115124902 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tp_account_actions (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL, loadid VARCHAR(64) DEFAULT \'DATABASE\' NOT NULL, tenant VARCHAR(64) NOT NULL, account VARCHAR(64) NOT NULL, action_plan_tag VARCHAR(64) DEFAULT NULL, action_triggers_tag VARCHAR(64) DEFAULT NULL, allow_negative TINYINT(1) DEFAULT \'0\' NOT NULL, disabled TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', companyId INT UNSIGNED NOT NULL, UNIQUE INDEX UNIQ_9C6C0B6E2480E723 (companyId), INDEX tpid (tpid), UNIQUE INDEX unique_tp_account (tpid, loadid, tenant, account, companyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tp_account_actions ADD CONSTRAINT FK_9C6C0B6E2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('CREATE TABLE tp_rates (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL, tag VARCHAR(64) DEFAULT NULL, connect_fee NUMERIC(10, 4) NOT NULL, rate NUMERIC(10, 4) NOT NULL, rate_unit VARCHAR(16) DEFAULT \'60s\' NOT NULL, rate_increment VARCHAR(16) NOT NULL, group_interval_start VARCHAR(16) DEFAULT \'0s\' NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', rateId INT UNSIGNED NOT NULL, INDEX IDX_DE7E762B925F3C99 (rateId), INDEX tpid (tpid), INDEX tpid_rtid (tpid, tag), UNIQUE INDEX unique_tprate (tpid, tag, group_interval_start, rateId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE RatingPlans (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tag VARCHAR(64) DEFAULT NULL, name_en VARCHAR(55) NOT NULL, name_es VARCHAR(55) NOT NULL, description_en VARCHAR(255) NOT NULL, description_es VARCHAR(255) NOT NULL, brandId INT UNSIGNED NOT NULL, INDEX IDX_EB67DB9C9CBEC244 (brandId), UNIQUE INDEX brandTag (tag, brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8  ENGINE = InnoDB');
        $this->addSql('CREATE TABLE DestinationRates (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tag VARCHAR(64) DEFAULT NULL, name_en VARCHAR(55) NOT NULL, name_es VARCHAR(55) NOT NULL, description_en VARCHAR(255) NOT NULL, description_es VARCHAR(255) NOT NULL, brandId INT UNSIGNED NOT NULL, INDEX brandId (brandId), UNIQUE INDEX brandTag (tag, brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tp_rating_profiles (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL, loadid VARCHAR(64) DEFAULT \'DATABASE\' NOT NULL, direction VARCHAR(8) DEFAULT \'*out\' NOT NULL, tenant VARCHAR(64) DEFAULT NULL, category VARCHAR(32) DEFAULT \'call\' NOT NULL, subject VARCHAR(64) DEFAULT NULL, activation_time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', rating_plan_tag VARCHAR(64) DEFAULT NULL, fallback_subjects VARCHAR(64) DEFAULT NULL, cdr_stat_queue_ids VARCHAR(64) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', companyId INT UNSIGNED NOT NULL, ratingPlanId INT UNSIGNED NOT NULL, INDEX IDX_8502DE0E2480E723 (companyId), INDEX IDX_8502DE0E5C17F7F9 (ratingPlanId), INDEX tpid (tpid), INDEX tpid_loadid (tpid, loadid), UNIQUE INDEX tpid_loadid_tenant_category_dir_subj_atime (tpid, loadid, tenant, subject, category, direction, activation_time), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Rates (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tag VARCHAR(64) DEFAULT NULL, name VARCHAR(255) NOT NULL, brandId INT UNSIGNED NOT NULL, INDEX brandId (brandId), UNIQUE INDEX brandTag (brandId, tag), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Destinations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tag VARCHAR(64) DEFAULT NULL, name_en VARCHAR(55) NOT NULL, name_es VARCHAR(55) NOT NULL, description_en VARCHAR(255) NOT NULL, description_es VARCHAR(255) NOT NULL, brandId INT UNSIGNED NOT NULL, INDEX brandId (brandId), UNIQUE INDEX brandTag (tag, brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tp_destination_rates (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL, tag VARCHAR(64) DEFAULT NULL, destinations_tag VARCHAR(64) DEFAULT NULL, rates_tag VARCHAR(64) DEFAULT NULL, rounding_method VARCHAR(255) DEFAULT \'*up\' NOT NULL, rounding_decimals INT DEFAULT 4 NOT NULL, max_cost NUMERIC(10, 4) DEFAULT \'0.000\' NOT NULL, max_cost_strategy VARCHAR(16) DEFAULT \'\' NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', destinationRateId INT UNSIGNED NOT NULL, destinationId INT UNSIGNED NOT NULL, rateId INT UNSIGNED NOT NULL, INDEX IDX_4823F9F84EB67480 (destinationRateId), INDEX IDX_4823F9F8BF3434FC (destinationId), INDEX IDX_4823F9F8925F3C99 (rateId), INDEX tpid (tpid), INDEX tpid_drid (tpid, tag), UNIQUE INDEX tpid_drid_dstid (tpid, tag, destinations_tag), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tp_rating_plans (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL, tag VARCHAR(64) DEFAULT NULL, destrates_tag VARCHAR(64) DEFAULT NULL, timing_tag VARCHAR(64) DEFAULT NULL, weight NUMERIC(8, 2) DEFAULT \'10\' NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', timingId INT UNSIGNED NOT NULL, ratingPlanId INT UNSIGNED NOT NULL, destinationRateId INT UNSIGNED NOT NULL, INDEX IDX_4CC2BCAB8E5B4C15 (timingId), INDEX IDX_4CC2BCAB5C17F7F9 (ratingPlanId), INDEX IDX_4CC2BCAB4EB67480 (destinationRateId), INDEX tpid (tpid), INDEX tpid_rpl (tpid, tag), UNIQUE INDEX tpid_rplid_destrates_timings_weight (tpid, tag, destrates_tag, timing_tag), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tp_timings (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL, tag VARCHAR(64) DEFAULT NULL, years VARCHAR(255) NOT NULL, months VARCHAR(255) NOT NULL, month_days VARCHAR(255) NOT NULL, week_days VARCHAR(255) NOT NULL, time VARCHAR(32) DEFAULT \'00:00:00\' NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', INDEX tpid (tpid), UNIQUE INDEX tpid_tag (tpid, tag), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tp_destinations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL, tag VARCHAR(64) DEFAULT NULL, prefix VARCHAR(24) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', destinationId INT UNSIGNED NOT NULL, INDEX IDX_C9806885BF3434FC (destinationId), INDEX tpid (tpid), INDEX tpid_dstid (tpid, tag), UNIQUE INDEX tpid_dest_prefix (tpid, tag, prefix, destinationId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tp_rates ADD CONSTRAINT FK_DE7E762B925F3C99 FOREIGN KEY (rateId) REFERENCES Rates (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RatingPlans ADD CONSTRAINT FK_EB67DB9C9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE DestinationRates ADD CONSTRAINT FK_6CAE066F9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_rating_profiles ADD CONSTRAINT FK_8502DE0E2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_rating_profiles ADD CONSTRAINT FK_8502DE0E5C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Rates ADD CONSTRAINT FK_851584389CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Destinations ADD CONSTRAINT FK_3502983B9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_destination_rates ADD CONSTRAINT FK_4823F9F84EB67480 FOREIGN KEY (destinationRateId) REFERENCES DestinationRates (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_destination_rates ADD CONSTRAINT FK_4823F9F8BF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_destination_rates ADD CONSTRAINT FK_4823F9F8925F3C99 FOREIGN KEY (rateId) REFERENCES Rates (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_rating_plans ADD CONSTRAINT FK_4CC2BCAB8E5B4C15 FOREIGN KEY (timingId) REFERENCES tp_timings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_rating_plans ADD CONSTRAINT FK_4CC2BCAB5C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_rating_plans ADD CONSTRAINT FK_4CC2BCAB4EB67480 FOREIGN KEY (destinationRateId) REFERENCES DestinationRates (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_destinations ADD CONSTRAINT FK_C9806885BF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE CASCADE');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tp_rating_profiles DROP FOREIGN KEY FK_8502DE0E5C17F7F9');
        $this->addSql('ALTER TABLE tp_rating_plans DROP FOREIGN KEY FK_4CC2BCAB5C17F7F9');
        $this->addSql('ALTER TABLE RatingPlans DROP FOREIGN KEY FK_EB67DB9C4EB67480');
        $this->addSql('ALTER TABLE tp_destination_rates DROP FOREIGN KEY FK_4823F9F84EB67480');
        $this->addSql('ALTER TABLE tp_rating_plans DROP FOREIGN KEY FK_4CC2BCAB4EB67480');
        $this->addSql('ALTER TABLE tp_rates DROP FOREIGN KEY FK_DE7E762B925F3C99');
        $this->addSql('ALTER TABLE tp_destination_rates DROP FOREIGN KEY FK_4823F9F8925F3C99');
        $this->addSql('ALTER TABLE tp_destination_rates DROP FOREIGN KEY FK_4823F9F8BF3434FC');
        $this->addSql('ALTER TABLE tp_destinations DROP FOREIGN KEY FK_C9806885BF3434FC');
        $this->addSql('ALTER TABLE tp_rating_plans DROP FOREIGN KEY FK_4CC2BCAB8E5B4C15');
        $this->addSql('DROP TABLE tp_rates');
        $this->addSql('DROP TABLE RatingPlans');
        $this->addSql('DROP TABLE DestinationRates');
        $this->addSql('DROP TABLE tp_rating_profiles');
        $this->addSql('DROP TABLE Rates');
        $this->addSql('DROP TABLE Destinations');
        $this->addSql('DROP TABLE tp_destination_rates');
        $this->addSql('DROP TABLE tp_rating_plans');
        $this->addSql('DROP TABLE tp_timings');
        $this->addSql('DROP TABLE tp_destinations');
        $this->addSql('DROP TABLE tp_account_actions');

    }
}
