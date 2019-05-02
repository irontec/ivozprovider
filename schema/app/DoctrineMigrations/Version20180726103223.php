<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180726103223 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tp_derived_chargers (
                                id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                                tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL,
                                loadid VARCHAR(64) DEFAULT \'DATABASE\' NOT NULL,
                                direction VARCHAR(8) DEFAULT \'*out\' NOT NULL,
                                tenant VARCHAR(64) NOT NULL,
                                category VARCHAR(32) DEFAULT \'call\' NOT NULL,
                                account VARCHAR(64) DEFAULT \'*any\' NOT NULL,
                                subject VARCHAR(64) DEFAULT \'*any\',
                                destination_ids VARCHAR(64) DEFAULT \'*any\',
                                runid VARCHAR(64) DEFAULT \'carrier\' NOT NULL,
                                run_filters VARCHAR(32) DEFAULT \'carrierId\' NOT NULL,
                                req_type_field VARCHAR(64) DEFAULT \'^*postpaid\' NOT NULL,
                                direction_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                tenant_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                category_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                account_field VARCHAR(64) DEFAULT \'carrierId\' NOT NULL,
                                subject_field VARCHAR(64) DEFAULT \'carrierId\' NOT NULL,
                                destination_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                setup_time_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                pdd_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                answer_time_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                usage_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                supplier_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                disconnect_cause_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                rated_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                cost_field VARCHAR(64) DEFAULT \'*default\' NOT NULL,
                                created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\',
                                brandId INT UNSIGNED NOT NULL,
                          UNIQUE INDEX UNIQ_1581A0539CBEC244 (brandId),
                          INDEX tpDerivedCharge_tpid (tpid),
                          PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('ALTER TABLE tp_derived_chargers ADD CONSTRAINT FK_1581A0539CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO tp_derived_chargers (tenant, brandId) SELECT CONCAT("b", id), id from Brands');
        $this->addSql('ALTER TABLE RatingProfiles ADD carrierId INT UNSIGNED DEFAULT NULL, CHANGE companyId companyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE RatingProfiles ADD CONSTRAINT FK_282687BB6709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_282687BB6709B1C ON RatingProfiles (carrierId)');
        $this->addSql('ALTER TABLE tp_account_actions ADD carrierId INT UNSIGNED DEFAULT NULL, CHANGE companyId companyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE tp_account_actions ADD CONSTRAINT FK_9C6C0B6E6709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9C6C0B6E6709B1C ON tp_account_actions (carrierId)');
        $this->addSql('INSERT INTO tp_account_actions (tenant, account, carrierId) SELECT CONCAT("b", brandId), CONCAT("cr", id), id FROM Carriers');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM tp_derived_chargers');
        $this->addSql('DELETE FROM tp_account_actions WHERE carrierId IS NOT NULL');
        $this->addSql('DROP TABLE tp_derived_chargers');
        $this->addSql('ALTER TABLE RatingProfiles DROP FOREIGN KEY FK_282687BB6709B1C');
        $this->addSql('DROP INDEX IDX_282687BB6709B1C ON RatingProfiles');
        $this->addSql('ALTER TABLE RatingProfiles DROP carrierId, CHANGE companyId companyId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_account_actions DROP FOREIGN KEY FK_9C6C0B6E6709B1C');
        $this->addSql('DROP INDEX UNIQ_9C6C0B6E6709B1C ON tp_account_actions');
        $this->addSql('ALTER TABLE tp_account_actions DROP carrierId, CHANGE companyId companyId INT UNSIGNED NOT NULL');
    }
}
