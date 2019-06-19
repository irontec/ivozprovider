<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180719150852 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE RatingProfiles (id INT UNSIGNED AUTO_INCREMENT NOT NULL, activationTime DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, companyId INT UNSIGNED NOT NULL, ratingPlanId INT UNSIGNED NOT NULL, routingTagId INT UNSIGNED DEFAULT NULL, INDEX IDX_282687BB2480E723 (companyId), INDEX IDX_282687BB5C17F7F9 (ratingPlanId), INDEX IDX_282687BBA48EA1F0 (routingTagId), UNIQUE INDEX ratingProfile_company_plan_tag (companyId, ratingPlanId, routingTagId, activationTime), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE RatingProfiles ADD CONSTRAINT FK_282687BB2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RatingProfiles ADD CONSTRAINT FK_282687BB5C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RatingProfiles ADD CONSTRAINT FK_282687BBA48EA1F0 FOREIGN KEY (routingTagId) REFERENCES RoutingTags (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO RatingProfiles (id, activationTime, companyId, ratingPlanId) SELECT id, activation_time, companyId, ratingPlanId FROM tp_rating_profiles');
        $this->addSql('ALTER TABLE tp_rating_profiles DROP FOREIGN KEY FK_8502DE0E2480E723');
        $this->addSql('ALTER TABLE tp_rating_profiles DROP FOREIGN KEY FK_8502DE0E5C17F7F9');
        $this->addSql('DROP INDEX IDX_8502DE0E2480E723 ON tp_rating_profiles');
        $this->addSql('DROP INDEX IDX_8502DE0E5C17F7F9 ON tp_rating_profiles');
        $this->addSql('ALTER TABLE tp_rating_profiles ADD ratingProfileId INT UNSIGNED NOT NULL, DROP companyId, DROP ratingPlanId');
        $this->addSql('UPDATE tp_rating_profiles SET ratingProfileId = id');
        $this->addSql('ALTER TABLE tp_rating_profiles ADD CONSTRAINT FK_8502DE0E692AE6A8 FOREIGN KEY (ratingProfileId) REFERENCES RatingProfiles (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8502DE0E692AE6A8 ON tp_rating_profiles (ratingProfileId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tp_rating_profiles DROP FOREIGN KEY FK_8502DE0E692AE6A8');
        $this->addSql('DROP TABLE RatingProfiles');
        $this->addSql('DROP INDEX UNIQ_8502DE0E692AE6A8 ON tp_rating_profiles');
        $this->addSql('ALTER TABLE tp_rating_profiles ADD ratingPlanId INT UNSIGNED NOT NULL, CHANGE ratingprofileid companyId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_rating_profiles ADD CONSTRAINT FK_8502DE0E2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_rating_profiles ADD CONSTRAINT FK_8502DE0E5C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlans (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8502DE0E2480E723 ON tp_rating_profiles (companyId)');
        $this->addSql('CREATE INDEX IDX_8502DE0E5C17F7F9 ON tp_rating_profiles (ratingPlanId)');
    }
}
