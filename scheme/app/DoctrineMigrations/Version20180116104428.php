<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180116104428 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE PricingPlansRelCompanies DROP FOREIGN KEY FK_78F195D2EDF37044');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns DROP FOREIGN KEY FK_CAD1B6B5EDF37044');
        $this->addSql('ALTER TABLE kam_acc_cdrs DROP FOREIGN KEY FK_1AC995A6EDF37044');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns DROP FOREIGN KEY FK_CAD1B6B54D2CFC16');
        $this->addSql('ALTER TABLE kam_acc_cdrs DROP FOREIGN KEY FK_1AC995A64D2CFC16');
        $this->addSql('DROP TABLE PricingPlans');
        $this->addSql('DROP TABLE PricingPlansRelCompanies');
        $this->addSql('DROP TABLE PricingPlansRelTargetPatterns');
        $this->addSql('DROP TABLE TargetPatterns');
        $this->addSql('DROP INDEX pricingPlanId ON kam_acc_cdrs');
        $this->addSql('DROP INDEX targetPatternId ON kam_acc_cdrs');

        $this->addSql('ALTER TABLE kam_acc_cdrs ADD ratingPlanId INT UNSIGNED DEFAULT NULL, ADD destinationId INT UNSIGNED DEFAULT NULL');
        $this->addSql('UPDATE kam_acc_cdrs SET ratingPlanId = pricingPlanId');
        $this->addSql('UPDATE kam_acc_cdrs SET destinationId = targetPatternId');
        $this->addSql('ALTER TABLE kam_acc_cdrs DROP pricingPlanId, DROP targetPatternId');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD CONSTRAINT FK_1AC995A65C17F7F9 FOREIGN KEY (ratingPlanId) REFERENCES RatingPlans (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD CONSTRAINT FK_1AC995A6BF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX ratingPlanId ON kam_acc_cdrs (ratingPlanId)');
        $this->addSql('CREATE INDEX destinationId ON kam_acc_cdrs (destinationId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE PricingPlans (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_en VARCHAR(55) NOT NULL COLLATE utf8_general_ci, name_es VARCHAR(55) NOT NULL COLLATE utf8_general_ci, description_en VARCHAR(55) NOT NULL COLLATE utf8_general_ci, description_es VARCHAR(55) NOT NULL COLLATE utf8_general_ci, createdOn DATETIME DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL COMMENT \'(DC2Type:datetime)\', brandId INT UNSIGNED NOT NULL, UNIQUE INDEX nameEsBrand (name_es, brandId), UNIQUE INDEX nameEnBrand (name_en, brandId), INDEX brandId (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PricingPlansRelCompanies (id INT UNSIGNED AUTO_INCREMENT NOT NULL, pricingPlanId INT UNSIGNED NOT NULL, companyId INT UNSIGNED NOT NULL, validFrom DATETIME NOT NULL COMMENT \'(DC2Type:datetime)\', validTo DATETIME NOT NULL COMMENT \'(DC2Type:datetime)\', metric INT DEFAULT 10 NOT NULL, brandId INT UNSIGNED NOT NULL, UNIQUE INDEX pricingPlanIdCompanyId (pricingPlanId, companyId), UNIQUE INDEX metricCompanyId (companyId, metric), INDEX brandId (brandId), INDEX IDX_78F195D22480E723 (companyId), INDEX IDX_78F195D2EDF37044 (pricingPlanId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PricingPlansRelTargetPatterns (id INT UNSIGNED AUTO_INCREMENT NOT NULL, connectionCharge NUMERIC(10, 4) NOT NULL, periodTime INT NOT NULL, perPeriodCharge NUMERIC(10, 4) NOT NULL, pricingPlanId INT UNSIGNED NOT NULL, targetPatternId INT UNSIGNED NOT NULL, brandId INT UNSIGNED NOT NULL, UNIQUE INDEX pricingPlanId (pricingPlanId, targetPatternId), INDEX targetPatternId (targetPatternId), INDEX brandId (brandId), INDEX IDX_CAD1B6B5EDF37044 (pricingPlanId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE TargetPatterns (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_en VARCHAR(55) NOT NULL COLLATE utf8_general_ci, name_es VARCHAR(55) NOT NULL COLLATE utf8_general_ci, description_en VARCHAR(55) NOT NULL COLLATE utf8_general_ci, description_es VARCHAR(55) NOT NULL COLLATE utf8_general_ci, `regExp` VARCHAR(80) NOT NULL COLLATE utf8_general_ci, brandId INT UNSIGNED NOT NULL, UNIQUE INDEX regExpBrand (`regExp`, brandId), INDEX brandId (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kam_trunks_acc_cdrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, calldate DATETIME DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL COMMENT \'(DC2Type:datetime)\', start_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', end_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', duration DOUBLE PRECISION DEFAULT \'0.000\' NOT NULL, caller VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, callee VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, type VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, subtype VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, companyId VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, companyName VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, asIden VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, asAddress VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, callid VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, xcallid VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, parsed VARCHAR(255) DEFAULT \'no\' COLLATE utf8_general_ci, diversion VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, peeringContractId VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, INDEX start_time_idx (start_time), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kam_users_acc_cdrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, calldate DATETIME DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL COMMENT \'(DC2Type:datetime)\', start_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', end_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', duration DOUBLE PRECISION DEFAULT \'0.000\' NOT NULL, caller VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, callee VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, type VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, subtype VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, companyId VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, companyName VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, asIden VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, asAddress VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, callid VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, xcallid VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, parsed VARCHAR(255) DEFAULT \'no\' COLLATE utf8_general_ci, diversion VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, peeringContractId VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, INDEX start_time_idx (start_time), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kam_users_trusted (id INT UNSIGNED AUTO_INCREMENT NOT NULL, src_ip VARCHAR(50) DEFAULT NULL COLLATE utf8_general_ci, proto VARCHAR(4) DEFAULT NULL COLLATE utf8_general_ci, from_pattern VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, ruri_pattern VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, tag VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, priority INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE PricingPlans ADD CONSTRAINT PricingPlans_ibfk_1 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT FK_78F195D22480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT FK_78F195D2EDF37044 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT PricingPlansRelCompanies_ibfk_3 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT FK_CAD1B6B54D2CFC16 FOREIGN KEY (targetPatternId) REFERENCES TargetPatterns (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT FK_CAD1B6B5EDF37044 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT PricingPlansRelTargetPatterns_ibfk_3 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_acc_cdrs DROP FOREIGN KEY FK_1AC995A65C17F7F9');
        $this->addSql('ALTER TABLE kam_acc_cdrs DROP FOREIGN KEY FK_1AC995A6BF3434FC');
        $this->addSql('DROP INDEX ratingPlanId ON kam_acc_cdrs');
        $this->addSql('DROP INDEX destinationId ON kam_acc_cdrs');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD pricingPlanId INT UNSIGNED DEFAULT NULL, ADD targetPatternId INT UNSIGNED DEFAULT NULL, DROP ratingPlanId, DROP destinationId');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD CONSTRAINT FK_1AC995A64D2CFC16 FOREIGN KEY (targetPatternId) REFERENCES TargetPatterns (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_acc_cdrs ADD CONSTRAINT FK_1AC995A6EDF37044 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX pricingPlanId ON kam_acc_cdrs (pricingPlanId)');
        $this->addSql('CREATE INDEX targetPatternId ON kam_acc_cdrs (targetPatternId)');
    }
}
