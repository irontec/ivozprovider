<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180726142227 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE DestinationRateGroups (id INT UNSIGNED AUTO_INCREMENT NOT NULL, status VARCHAR(20) DEFAULT NULL COMMENT \'[enum:waiting|inProgress|imported|error]\', name_en VARCHAR(55) NOT NULL, name_es VARCHAR(55) NOT NULL, description_en VARCHAR(255) NOT NULL, description_es VARCHAR(255) NOT NULL, fileFileSize INT UNSIGNED DEFAULT NULL COMMENT \'[FSO]\', fileMimeType VARCHAR(80) DEFAULT NULL, fileBaseName VARCHAR(255) DEFAULT NULL, fileImporterArguments LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', brandId INT UNSIGNED NOT NULL, INDEX IDX_2930FE169CBEC244 (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Destinations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, prefix VARCHAR(24) NOT NULL, name_en VARCHAR(100) DEFAULT NULL, name_es VARCHAR(100) DEFAULT NULL, brandId INT UNSIGNED NOT NULL, INDEX IDX_3502983B9CBEC244 (brandId), UNIQUE INDEX destination_prefix_brand (prefix, brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');

        // Migrate data from DestinationRates to DestinationRateGroups
        $this->addSql('INSERT INTO DestinationRateGroups (id, name_en, name_es, description_en, description_es, brandId)
                              SELECT id, name_en, name_es, description_en, description_es, brandId from DestinationRates');

        // Migrate data from tp_destinations to Destinations (ignore duplicates)
        $this->addSql('INSERT IGNORE INTO Destinations (prefix, name_en, name_es, brandId)
                              SELECT prefix, prefix_name, prefix_name, brandId FROM tp_destination_rates AS TDR
                                INNER JOIN DestinationRates DR on DR.id = TDR.destinationRateId');

        $this->addSql('ALTER TABLE DestinationRateGroups ADD CONSTRAINT FK_2930FE169CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Destinations ADD CONSTRAINT FK_3502983B9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE DestinationRates DROP FOREIGN KEY FK_6CAE066F9CBEC244');
        $this->addSql('DROP INDEX destinationRate_brandTag ON DestinationRates');
        $this->addSql('DROP INDEX destinationRate_brandId ON DestinationRates');
        $this->addSql('ALTER TABLE DestinationRates ADD rate NUMERIC(10, 4) NOT NULL, ADD connectFee NUMERIC(10, 4) NOT NULL, ADD rateIncrement VARCHAR(16) NOT NULL, ADD groupIntervalStart VARCHAR(16) DEFAULT \'0s\' NOT NULL, ADD destinationId INT UNSIGNED NOT NULL, DROP tag, DROP name_en, DROP name_es, DROP description_en, DROP description_es, DROP status, DROP fileFileSize, DROP fileMimeType, DROP fileBaseName, DROP fileImporterArguments, CHANGE brandid destinationRateGroupId INT UNSIGNED NOT NULL');

        // Migrate data from tp_destination_rates to DestinationRates
        $this->addSql('INSERT INTO DestinationRates (destinationRateGroupId, rate, connectFee, rateIncrement, groupIntervalStart, destinationId) SELECT DRG.id, rate, connect_fee, TDR.rate_increment, group_interval_start, (SELECT id FROM Destinations WHERE prefix = TDR.prefix AND brandId = DRG.brandId) FROM tp_destination_rates TDR INNER JOIN DestinationRateGroups DRG ON DRG.id = TDR.destinationRateId');

        // Remove old residual data
        $this->addSql('ALTER TABLE tp_rating_plans DROP FOREIGN KEY FK_4CC2BCAB4EB67480');
        $this->addSql('DELETE FROM DestinationRates WHERE destinationRateGroupId NOT IN (SELECT id FROM DestinationRateGroups)');
        $this->addSql('DELETE FROM DestinationRates WHERE destinationId NOT IN (SELECT id FROM Destinations)');
        $this->addSql('DELETE FROM tp_rates');
        $this->addSql('DELETE FROM tp_destination_rates');
        $this->addSql('DELETE FROM tp_destinations');

        $this->addSql('ALTER TABLE DestinationRates ADD CONSTRAINT FK_6CAE066FC11683D9 FOREIGN KEY (destinationRateGroupId) REFERENCES DestinationRateGroups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE DestinationRates ADD CONSTRAINT FK_6CAE066FBF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_6CAE066FC11683D9 ON DestinationRates (destinationRateGroupId)');
        $this->addSql('CREATE INDEX IDX_6CAE066FBF3434FC ON DestinationRates (destinationId)');
        $this->addSql('CREATE UNIQUE INDEX destinationRate_destination ON DestinationRates (destinationRateGroupId, destinationId)');
        $this->addSql('ALTER TABLE tp_rates DROP FOREIGN KEY FK_DE7E762B2B3C4634');
        $this->addSql('DROP INDEX UNIQ_DE7E762B2B3C4634 ON tp_rates');
        $this->addSql('DROP INDEX unique_tprate ON tp_rates');
        $this->addSql('ALTER TABLE tp_rates CHANGE tpdestinationrateid destinationRateId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_rates ADD CONSTRAINT FK_DE7E762B4EB67480 FOREIGN KEY (destinationRateId) REFERENCES DestinationRates (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE7E762B4EB67480 ON tp_rates (destinationRateId)');
        $this->addSql('CREATE UNIQUE INDEX unique_tprate ON tp_rates (tpid, tag, group_interval_start)');
        $this->addSql('ALTER TABLE tp_destination_rates DROP INDEX IDX_4823F9F84EB67480, ADD UNIQUE INDEX UNIQ_4823F9F84EB67480 (destinationRateId)');
        $this->addSql('DROP INDEX destinationRate_prefix ON tp_destination_rates');
        $this->addSql('ALTER TABLE tp_destination_rates DROP prefix, DROP prefix_name, DROP rate, DROP connect_fee, DROP rate_increment, DROP group_interval_start');
        $this->addSql('ALTER TABLE tp_destinations DROP FOREIGN KEY FK_C98068852B3C4634');
        $this->addSql('DROP INDEX UNIQ_C98068852B3C4634 ON tp_destinations');
        $this->addSql('DROP INDEX tpid_dest_prefix ON tp_destinations');
        $this->addSql('ALTER TABLE tp_destinations DROP name, CHANGE tpdestinationrateid destinationId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_destinations ADD CONSTRAINT FK_C9806885BF3434FC FOREIGN KEY (destinationId) REFERENCES Destinations (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C9806885BF3434FC ON tp_destinations (destinationId)');
        $this->addSql('CREATE UNIQUE INDEX tpid_dest_prefix ON tp_destinations (tpid, tag, prefix)');

        // Generate tp_destinations from Destinations
        $this->addSql('INSERT INTO tp_destinations (tag, prefix, destinationId) SELECT CONCAT("b", brandId, "dst", id), prefix, id FROM Destinations');

        // Generate tp_rates from DestinationRates
        $this->addSql('INSERT INTO tp_rates (tag, connect_fee, rate, rate_increment, group_interval_start, destinationRateId) SELECT CONCAT("b", DRG.brandId, "rt", DR.id), DR.connectFee, DR.rate, DR.rateIncrement, DR.groupIntervalStart, DR.id FROM DestinationRates DR INNER JOIN DestinationRateGroups DRG ON DRG.id = DR.destinationRateGroupId');

        // Generate tp_destination_rates from DestinationRates
        $this->addSql('INSERT INTO tp_destination_rates (tag, destinations_tag, rates_tag, destinationRateId) SELECT CONCAT("b", DRG.brandId, "dr", DRG.id), CONCAT("b", DRG.brandId, "dst", DR.destinationId), CONCAT("b", DRG.brandId, "rt", DR.id), DR.id FROM DestinationRates DR INNER JOIN DestinationRateGroups DRG ON DRG.id = DR.destinationRateGroupId');

        // Remove unused fields from kam_trunks_cdrs
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB64EB67480');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB6B2A236E6');
        $this->addSql('DROP INDEX IDX_92E58EB64EB67480 ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX IDX_92E58EB6B2A236E6 ON kam_trunks_cdrs');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP destinationRateId, DROP tpDestinationId');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD destinationRateId INT UNSIGNED DEFAULT NULL, ADD tpDestinationId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB64EB67480 FOREIGN KEY (destinationRateId) REFERENCES DestinationRates (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB6B2A236E6 FOREIGN KEY (tpDestinationId) REFERENCES tp_destinations (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_92E58EB64EB67480 ON kam_trunks_cdrs (destinationRateId)');
        $this->addSql('CREATE INDEX IDX_92E58EB6B2A236E6 ON kam_trunks_cdrs (tpDestinationId)');

        $this->addSql('ALTER TABLE DestinationRates DROP FOREIGN KEY FK_6CAE066FC11683D9');
        $this->addSql('ALTER TABLE DestinationRates DROP FOREIGN KEY FK_6CAE066FBF3434FC');
        $this->addSql('ALTER TABLE tp_destinations DROP FOREIGN KEY FK_C9806885BF3434FC');
        $this->addSql('DROP TABLE DestinationRateGroups');
        $this->addSql('DROP TABLE Destinations');
        $this->addSql('DROP INDEX IDX_6CAE066FC11683D9 ON DestinationRates');
        $this->addSql('DROP INDEX IDX_6CAE066FBF3434FC ON DestinationRates');
        $this->addSql('DROP INDEX destinationRate_destination ON DestinationRates');
        $this->addSql('ALTER TABLE DestinationRates ADD tag VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, ADD name_en VARCHAR(55) NOT NULL COLLATE utf8_general_ci, ADD name_es VARCHAR(55) NOT NULL COLLATE utf8_general_ci, ADD description_en VARCHAR(255) NOT NULL COLLATE utf8_general_ci, ADD description_es VARCHAR(255) NOT NULL COLLATE utf8_general_ci, ADD brandId INT UNSIGNED NOT NULL, ADD status VARCHAR(20) DEFAULT NULL COLLATE utf8_general_ci COMMENT \'[enum:waiting|inProgress|imported|error]\', ADD fileFileSize INT UNSIGNED DEFAULT NULL COMMENT \'[FSO]\', ADD fileMimeType VARCHAR(80) DEFAULT NULL COLLATE utf8_general_ci, ADD fileBaseName VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, ADD fileImporterArguments LONGTEXT DEFAULT NULL COLLATE utf8_general_ci COMMENT \'(DC2Type:json_array)\', DROP rate, DROP connectFee, DROP rateIncrement, DROP groupIntervalStart, DROP destinationRateGroupId, DROP destinationId');
        $this->addSql('ALTER TABLE DestinationRates ADD CONSTRAINT FK_6CAE066F9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX destinationRate_brandTag ON DestinationRates (tag, brandId)');
        $this->addSql('CREATE INDEX destinationRate_brandId ON DestinationRates (brandId)');
        $this->addSql('ALTER TABLE tp_destination_rates DROP INDEX UNIQ_4823F9F84EB67480, ADD INDEX IDX_4823F9F84EB67480 (destinationRateId)');
        $this->addSql('ALTER TABLE tp_destination_rates ADD prefix VARCHAR(24) NOT NULL COLLATE utf8_general_ci, ADD prefix_name VARCHAR(60) NOT NULL COLLATE utf8_general_ci, ADD rate NUMERIC(10, 4) NOT NULL, ADD connect_fee NUMERIC(10, 4) NOT NULL, ADD rate_increment VARCHAR(16) NOT NULL COLLATE utf8_general_ci, ADD group_interval_start VARCHAR(16) DEFAULT \'0s\' NOT NULL COLLATE utf8_general_ci');
        $this->addSql('CREATE UNIQUE INDEX destinationRate_prefix ON tp_destination_rates (destinationRateId, prefix)');
        $this->addSql('DROP INDEX UNIQ_C9806885BF3434FC ON tp_destinations');
        $this->addSql('DROP INDEX tpid_dest_prefix ON tp_destinations');
        $this->addSql('ALTER TABLE tp_destinations ADD name VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, CHANGE destinationid tpDestinationRateId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_destinations ADD CONSTRAINT FK_C98068852B3C4634 FOREIGN KEY (tpDestinationRateId) REFERENCES tp_destination_rates (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C98068852B3C4634 ON tp_destinations (tpDestinationRateId)');
        $this->addSql('CREATE UNIQUE INDEX tpid_dest_prefix ON tp_destinations (tpid, tag, prefix, tpDestinationRateId)');
        $this->addSql('ALTER TABLE tp_rates DROP FOREIGN KEY FK_DE7E762B4EB67480');
        $this->addSql('DROP INDEX UNIQ_DE7E762B4EB67480 ON tp_rates');
        $this->addSql('DROP INDEX unique_tprate ON tp_rates');
        $this->addSql('ALTER TABLE tp_rates CHANGE destinationrateid tpDestinationRateId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE tp_rates ADD CONSTRAINT FK_DE7E762B2B3C4634 FOREIGN KEY (tpDestinationRateId) REFERENCES tp_destination_rates (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE7E762B2B3C4634 ON tp_rates (tpDestinationRateId)');
        $this->addSql('CREATE UNIQUE INDEX unique_tprate ON tp_rates (tpid, tag, group_interval_start, tpDestinationRateId)');
        $this->addSql('ALTER TABLE tp_rating_plans ADD CONSTRAINT FK_4CC2BCAB4EB67480 FOREIGN KEY (destinationRateId) REFERENCES DestinationRates (id) ON DELETE CASCADE');
    }
}
