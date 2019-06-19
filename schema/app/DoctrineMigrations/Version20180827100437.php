<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180827100437 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE OutgoingRoutingRelCarriers (
                              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                              outgoingRoutingId INT UNSIGNED NOT NULL,
                              carrierId INT UNSIGNED NOT NULL,
                              INDEX IDX_BD8A311D3CDE892 (outgoingRoutingId),
                              INDEX IDX_BD8A311D6709B1C (carrierId),
                          UNIQUE INDEX outgoingRoutingRelCarrier_carrier (outgoingRoutingId, carrierId),
                          PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB'
        );

        $this->addSql('CREATE TABLE tp_lcr_rules (
                              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                              tpid VARCHAR(64) DEFAULT \'ivozprovider\' NOT NULL,
                              direction VARCHAR(8) DEFAULT \'*out\' NOT NULL,
                              tenant VARCHAR(64) NOT NULL,
                              category VARCHAR(32) NOT NULL,
                              account VARCHAR(64) DEFAULT \'*any\' NOT NULL,
                              subject VARCHAR(64) DEFAULT \'*any\',
                              destination_tag VARCHAR(64) DEFAULT \'*any\',
                              rp_category VARCHAR(32) NOT NULL,
                              strategy VARCHAR(18) DEFAULT \'*lowest_cost\' NOT NULL,
                              strategy_params VARCHAR(256) DEFAULT \'\',
                              activation_time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\',
                              weight NUMERIC(8, 2) DEFAULT \'10\' NOT NULL,
                              created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime)\',
                              outgoingRoutingId INT UNSIGNED DEFAULT NULL,
                          UNIQUE INDEX UNIQ_C700333B3CDE892 (outgoingRoutingId),
                          INDEX tpLcrRule_tpid (tpid),
                          PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB'
        );

        $this->addSql('ALTER TABLE OutgoingRoutingRelCarriers ADD CONSTRAINT FK_BD8A311D3CDE892 FOREIGN KEY (outgoingRoutingId) REFERENCES OutgoingRouting (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE OutgoingRoutingRelCarriers ADD CONSTRAINT FK_BD8A311D6709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_lcr_rules ADD CONSTRAINT FK_C700333B3CDE892 FOREIGN KEY (outgoingRoutingId) REFERENCES OutgoingRouting (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE OutgoingRouting ADD routingMode VARCHAR(25) DEFAULT \'static\' COMMENT \'[enum:static|lcr]\', CHANGE carrierId carrierId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways CHANGE carrierServerId carrierServerId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE tp_rating_profiles DROP INDEX UNIQ_8502DE0E692AE6A8, ADD INDEX IDX_8502DE0E692AE6A8 (ratingProfileId)');
        $this->addSql('ALTER TABLE tp_rating_profiles ADD outgoingRoutingRelCarrierId INT UNSIGNED DEFAULT NULL, CHANGE ratingProfileId ratingProfileId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE tp_rating_profiles ADD CONSTRAINT FK_8502DE0E622624F7 FOREIGN KEY (outgoingRoutingRelCarrierId) REFERENCES OutgoingRoutingRelCarriers (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8502DE0E622624F7 ON tp_rating_profiles (outgoingRoutingRelCarrierId)');

        // Remove unused field on RatingPlans (this can be calculated)
        $this->addSql('DROP INDEX brandTag ON RatingPlans');
        $this->addSql('ALTER TABLE RatingPlans DROP tag');


        // Insert Dummy gateway
        $this->addSql('SET SESSION sql_mode=\'NO_AUTO_VALUE_ON_ZERO\'');
        $this->addSql('INSERT INTO kam_trunks_lcr_gateways (id, gw_name, hostname, carrierServerId) VALUES (0, \'LcrDummyGateway\', \'dummy.ivozprovider.local\', NULL);');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE RatingPlans ADD tag VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('CREATE UNIQUE INDEX brandTag ON RatingPlans (tag, brandId)');
        $this->addSql('ALTER TABLE tp_rating_profiles DROP FOREIGN KEY FK_8502DE0E622624F7');
        $this->addSql('DROP TABLE OutgoingRoutingRelCarriers');
        $this->addSql('DROP TABLE tp_lcr_rules');
        $this->addSql('ALTER TABLE OutgoingRouting DROP routingMode, CHANGE carrierId carrierId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways CHANGE carrierServerId carrierServerId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_rating_profiles DROP INDEX IDX_8502DE0E692AE6A8, ADD UNIQUE INDEX UNIQ_8502DE0E692AE6A8 (ratingProfileId)');
        $this->addSql('DROP INDEX IDX_8502DE0E622624F7 ON tp_rating_profiles');
        $this->addSql('ALTER TABLE tp_rating_profiles DROP outgoingRoutingRelCarrierId, CHANGE ratingProfileId ratingProfileId INT UNSIGNED NOT NULL');
    }
}
