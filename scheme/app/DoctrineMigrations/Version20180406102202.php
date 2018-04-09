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
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB6BF3434FC');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD tpDestinationId INT UNSIGNED DEFAULT NULL');
        $this->addSql('UPDATE kam_trunks_cdrs KTC INNER JOIN tp_destinations TD ON TD.destinationId = KTC.destinationId SET KTC.tpDestinationId = TD.id');
        $this->addSql('CREATE INDEX IDX_92E58EB6B2A236E6 ON kam_trunks_cdrs (tpDestinationId)');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB6B2A236E6 FOREIGN KEY (tpDestinationId) REFERENCES tp_destinations (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP destinationId');

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

        $this->addSql('CREATE TABLE Destinations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tag VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, name_en VARCHAR(55) NOT NULL COLLATE utf8_general_ci, name_es VARCHAR(55) NOT NULL COLLATE utf8_general_ci, description_en VARCHAR(255) NOT NULL COLLATE utf8_general_ci, description_es VARCHAR(255) NOT NULL COLLATE utf8_general_ci, brandId INT UNSIGNED NOT NULL, UNIQUE INDEX destination_brandTag (tag, brandId), INDEX destination_brandId (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Rates (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tag VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, name VARCHAR(255) NOT NULL COLLATE utf8_general_ci, brandId INT UNSIGNED NOT NULL, UNIQUE INDEX rate_brandTag (brandId, tag), INDEX rate_brandId (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Destinations ADD CONSTRAINT FK_3502983B9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Rates ADD CONSTRAINT FK_851584389CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE DestinationRates DROP status, DROP fileFileSize, DROP fileMimeType, DROP fileBaseName, DROP fileImporterArguments');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB6BF3434FC');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB6BF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tp_destination_rates ADD destinationId INT UNSIGNED NOT NULL, ADD rateId INT UNSIGNED NOT NULL, DROP prefix, DROP prefix_name, DROP rate, DROP connect_fee, DROP rate_increment, DROP group_interval_start');
        $this->addSql('ALTER TABLE tp_destination_rates ADD CONSTRAINT FK_4823F9F8925F3C99 FOREIGN KEY (rateId) REFERENCES Rates (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp_destination_rates ADD CONSTRAINT FK_4823F9F8BF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4823F9F8BF3434FC ON tp_destination_rates (destinationId)');
        $this->addSql('CREATE INDEX IDX_4823F9F8925F3C99 ON tp_destination_rates (rateId)');
        $this->addSql('ALTER TABLE tp_destinations DROP FOREIGN KEY FK_C98068852B3C4634');
        $this->addSql('DROP INDEX destinationRate_prefix ON tp_destination_rates');
        $this->addSql('DROP INDEX IDX_C98068852B3C4634 ON tp_destinations');
        $this->addSql('DROP INDEX tpid_dest_prefix ON tp_destinations');
        $this->addSql('ALTER TABLE tp_destinations CHANGE tpdestinationrateid destinationId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_destinations ADD CONSTRAINT FK_C9806885BF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C9806885BF3434FC ON tp_destinations (destinationId)');
        $this->addSql('CREATE UNIQUE INDEX tpid_dest_prefix ON tp_destinations (tpid, tag, prefix, destinationId)');
        $this->addSql('ALTER TABLE tp_rates DROP FOREIGN KEY FK_DE7E762B2B3C4634');
        $this->addSql('DROP INDEX IDX_DE7E762B2B3C4634 ON tp_rates');
        $this->addSql('DROP INDEX unique_tprate ON tp_rates');
        $this->addSql('ALTER TABLE tp_rates CHANGE tpdestinationrateid rateId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_rates ADD CONSTRAINT FK_DE7E762B925F3C99 FOREIGN KEY (rateId) REFERENCES Rates (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_DE7E762B925F3C99 ON tp_rates (rateId)');
        $this->addSql('CREATE UNIQUE INDEX unique_tprate ON tp_rates (tpid, tag, group_interval_start, rateId)');
    }
}
