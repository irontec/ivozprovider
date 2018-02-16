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

        $this->addSql('DROP TABLE PricingPlansRelCompanies');
        $this->addSql('DROP TABLE PricingPlansRelTargetPatterns');
        $this->addSql('DROP TABLE PricingPlans');
        $this->addSql('DROP TABLE TargetPatterns');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE PricingPlans (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_en VARCHAR(55) NOT NULL, name_es VARCHAR(55) NOT NULL, description_en VARCHAR(55) NOT NULL, description_es VARCHAR(55) NOT NULL, createdOn DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\', brandId INT UNSIGNED NOT NULL, UNIQUE INDEX nameEsBrand (name_es, brandId), UNIQUE INDEX nameEnBrand (name_en, brandId), INDEX IDX_9AA416889CBEC244 (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PricingPlansRelCompanies (id INT UNSIGNED AUTO_INCREMENT NOT NULL, pricingPlanId INT UNSIGNED NOT NULL, companyId INT UNSIGNED NOT NULL, validFrom DATETIME NOT NULL COMMENT \'(DC2Type:datetime)\', validTo DATETIME NOT NULL COMMENT \'(DC2Type:datetime)\', metric INT DEFAULT 10 NOT NULL, brandId INT UNSIGNED NOT NULL, UNIQUE INDEX pricingPlanIdCompanyId (pricingPlanId, companyId), UNIQUE INDEX metricCompanyId (companyId, metric), INDEX IDX_78F195D29CBEC244 (brandId), INDEX IDX_78F195D22480E723 (companyId), INDEX IDX_78F195D2EDF37044 (pricingPlanId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PricingPlansRelTargetPatterns (id INT UNSIGNED AUTO_INCREMENT NOT NULL, connectionCharge NUMERIC(10, 4) NOT NULL, periodTime INT NOT NULL, perPeriodCharge NUMERIC(10, 4) NOT NULL, pricingPlanId INT UNSIGNED NOT NULL, targetPatternId INT UNSIGNED NOT NULL, brandId INT UNSIGNED NOT NULL, UNIQUE INDEX pricingPlanId (pricingPlanId, targetPatternId), INDEX IDX_CAD1B6B54D2CFC16 (targetPatternId), INDEX IDX_CAD1B6B59CBEC244 (brandId), INDEX IDX_CAD1B6B5EDF37044 (pricingPlanId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE TargetPatterns (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_en VARCHAR(55) NOT NULL, name_es VARCHAR(55) NOT NULL, description_en VARCHAR(55) NOT NULL, description_es VARCHAR(55) NOT NULL, `regExp` VARCHAR(80) NOT NULL, brandId INT UNSIGNED NOT NULL, UNIQUE INDEX regExpBrand (`regExp`, brandId), INDEX IDX_9A9F9F489CBEC244 (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE PricingPlans ADD CONSTRAINT PricingPlans_ibfk_1 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT FK_78F195D22480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT FK_78F195D2EDF37044 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelCompanies ADD CONSTRAINT PricingPlansRelCompanies_ibfk_3 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT FK_CAD1B6B54D2CFC16 FOREIGN KEY (targetPatternId) REFERENCES TargetPatterns (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT FK_CAD1B6B5EDF37044 FOREIGN KEY (pricingPlanId) REFERENCES PricingPlans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PricingPlansRelTargetPatterns ADD CONSTRAINT PricingPlansRelTargetPatterns_ibfk_3 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE TargetPatterns ADD CONSTRAINT TargetPatterns_ibfk_1 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
    }
}
