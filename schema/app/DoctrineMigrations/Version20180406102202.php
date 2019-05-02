<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180406102202 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Add new fields to DestinationRates
        $this->addSql('ALTER TABLE DestinationRates
          ADD status VARCHAR(20) DEFAULT NULL COMMENT \'[enum:waiting|inProgress|imported|error]\',
          ADD fileFileSize INT UNSIGNED DEFAULT NULL COMMENT \'[FSO]\',
          ADD fileMimeType VARCHAR(80) DEFAULT NULL,
          ADD fileBaseName VARCHAR(255) DEFAULT NULL,
          ADD fileImporterArguments LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\''
        );

        // Add new fields to tp_destination_rates
        $this->addSql('ALTER TABLE tp_destination_rates
                          ADD prefix VARCHAR(24) NOT NULL,
                          ADD prefix_name VARCHAR(60) NOT NULL,
                          ADD rate NUMERIC(10, 4) NOT NULL,
                          ADD connect_fee NUMERIC(10, 4) NOT NULL,
                          ADD rate_increment VARCHAR(16) NOT NULL,
                          ADD group_interval_start VARCHAR(16) DEFAULT \'0s\' NOT NULL'
        );

        // Associate tp_rates entries with tp_destination_rates
        $this->addSql('ALTER TABLE tp_rates ADD tpDestinationRateId INT UNSIGNED NOT NULL');
        $this->addSql('UPDATE tp_rates TR INNER JOIN tp_destination_rates TDR ON TDR.rateId = TR.rateId SET tpDestinationRateId = TDR.id');
        $this->addSql('ALTER TABLE tp_rates ADD UNIQUE INDEX UNIQ_DE7E762B2B3C4634 (tpDestinationRateId)');
        $this->addSql('ALTER TABLE tp_rates ADD CONSTRAINT FK_DE7E762B2B3C4634 FOREIGN KEY (tpDestinationRateId) REFERENCES tp_destination_rates (id) ON DELETE CASCADE');

        // Associate tp_destinations entries with tp_destination_rates
        $this->addSql('ALTER TABLE tp_destinations ADD name VARCHAR(64) DEFAULT NULL, ADD tpDestinationRateId INT UNSIGNED NOT NULL');
        $this->addSql('UPDATE tp_destinations TD INNER JOIN Destinations D ON TD.destinationId = D.id SET TD.name = D.name_en;');
        $this->addSql('UPDATE tp_destinations TD INNER JOIN tp_destination_rates TDR ON TDR.destinationId = TD.destinationId SET tpDestinationRateId = TDR.id');
        $this->addSql('DELETE FROM tp_destinations WHERE tpDestinationRateId = 0');  // Delete not used tp_destinations
        $this->addSql('ALTER TABLE tp_destinations ADD UNIQUE INDEX UNIQ_C98068852B3C4634 (tpDestinationRateId)');
        $this->addSql('ALTER TABLE tp_destinations ADD CONSTRAINT FK_C98068852B3C4634 FOREIGN KEY (tpDestinationRateId) REFERENCES tp_destination_rates (id) ON DELETE CASCADE');

        // Create new tp_destination for reused destinations in DestinationRates
        $this->addSql('INSERT INTO tp_destinations (prefix, name, destinationId, tpDestinationRateId)
                              SELECT TD.prefix, D.name_en, D.id, TDR.id
                                FROM tp_destination_rates TDR
                                INNER JOIN Destinations D ON D.id = TDR.destinationId
                                INNER JOIN tp_destinations TD ON TD.destinationId = D.id
                              WHERE TDR.id NOT IN (SELECT tpDestinationRateId FROM tp_destinations)');

        // Associate kam_trunks_cdrs with tp_destinations instead of Destinations
        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB6BF3434FC');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD tpDestinationId INT UNSIGNED DEFAULT NULL');

        $step = 500000;
        $rows = $this->connection->query("SELECT 1 FROM kam_trunks_cdrs")->rowCount();
        while ($rows > 0) {
            $limit = ($rows > $step) ? $step : $rows;
            $this->addSql("UPDATE kam_trunks_cdrs KTC SET KTC.tpDestinationId = (SELECT id FROM tp_destinations TD WHERE TD.destinationId = KTC.destinationId LIMIT 1) WHERE KTC.tpDestinationId IS NULL LIMIT $limit");
            $rows -= $limit;
        }


        $this->addSql('CREATE INDEX IDX_92E58EB6B2A236E6 ON kam_trunks_cdrs (tpDestinationId)');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB6B2A236E6 FOREIGN KEY (tpDestinationId) REFERENCES tp_destinations (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP destinationId');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');

        // Update new tp_destination_rates fields with tp_destinations and tp_rates contents
        $this->addSql('UPDATE tp_destination_rates TDR INNER JOIN tp_destinations TD ON TD.tpDestinationRateId = TDR.id
                            SET TDR.prefix_name = TD.name, TDR.prefix = TD.prefix');
        $this->addSql('UPDATE tp_destination_rates TDR INNER JOIN tp_rates TR ON TR.tpDestinationRateId = TDR.id
                            SET TDR.connect_fee = TR.connect_fee, TDR.rate = TR.rate, TDR.rate_increment = TR.rate_increment');
        $this->addSql('UPDATE DestinationRates SET tag = CONCAT("b", brandId, "dr", id)');
        $this->addSql('UPDATE tp_destination_rates TDR INNER JOIN DestinationRates DR ON DR.id = TDR.destinationRateId SET TDR.tag = DR.tag');
        $this->addSql('UPDATE tp_destination_rates SET destinations_tag = CONCAT(tag, "dst", id), rates_tag = CONCAT(tag, "rt", id)');
        $this->addSql('UPDATE tp_rates TR INNER JOIN tp_destination_rates TDR ON TDR.id = TR.tpDestinationRateId SET TR.tag = TDR.rates_tag');
        $this->addSql('UPDATE tp_destinations TD INNER JOIN tp_destination_rates TDR ON TDR.id = TD.tpDestinationRateId SET TD.tag = TDR.destinations_tag');

        // Remove all obsolete data
        $this->addSql('ALTER TABLE tp_rates DROP FOREIGN KEY FK_DE7E762B925F3C99');
        $this->addSql('DROP INDEX IDX_DE7E762B925F3C99 ON tp_rates');
        $this->addSql('DROP INDEX unique_tprate ON tp_rates');
        $this->addSql('CREATE UNIQUE INDEX unique_tprate ON tp_rates (tpid, tag, group_interval_start, tpDestinationRateId)');
        $this->addSql('ALTER TABLE tp_rates DROP rateid');
        $this->addSql('ALTER TABLE tp_destinations DROP FOREIGN KEY FK_C9806885BF3434FC');
        $this->addSql('DROP INDEX IDX_C9806885BF3434FC ON tp_destinations');
        $this->addSql('DROP INDEX tpid_dest_prefix ON tp_destinations');
        $this->addSql('CREATE UNIQUE INDEX tpid_dest_prefix ON tp_destinations (tpid, tag, prefix, tpDestinationRateId)');
        $this->addSql('ALTER TABLE tp_destinations DROP destinationid');
        $this->addSql('CREATE UNIQUE INDEX destinationRate_prefix ON tp_destination_rates (destinationRateId, prefix)');
        $this->addSql('ALTER TABLE tp_destination_rates DROP FOREIGN KEY FK_4823F9F8925F3C99');
        $this->addSql('ALTER TABLE tp_destination_rates DROP FOREIGN KEY FK_4823F9F8BF3434FC');
        $this->addSql('DROP INDEX IDX_4823F9F8925F3C99 ON tp_destination_rates');
        $this->addSql('DROP INDEX IDX_4823F9F8BF3434FC ON tp_destination_rates');
        $this->addSql('ALTER TABLE tp_destination_rates DROP destinationId, DROP rateId');
        $this->addSql('DROP TABLE Destinations');
        $this->addSql('DROP TABLE Rates');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        throw new \Exception('There is no save way to reserve this migration');
    }
}
