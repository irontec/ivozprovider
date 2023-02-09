<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220324123318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE BillableCalls CHANGE priceDetails priceDetails JSON DEFAULT NULL');
        $this->addSql('UPDATE Changelog SET data = \'{}\' WHERE entityId = 0 and data=\'\'');
        $this->addSql('ALTER TABLE Changelog CHANGE data data JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE Commandlog CHANGE arguments arguments JSON DEFAULT NULL, CHANGE agent agent JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE DestinationRateGroups CHANGE fileImporterArguments fileImporterArguments JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE tp_cdrs CHANGE cost_details cost_details JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE BillableCalls CHANGE priceDetails priceDetails JSON CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE Changelog CHANGE data data JSON CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE Commandlog CHANGE arguments arguments JSON CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json_array)\', CHANGE agent agent JSON CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE DestinationRateGroups CHANGE fileImporterArguments fileImporterArguments JSON CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE tp_cdrs CHANGE cost_details cost_details JSON CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci` COMMENT \'(DC2Type:json_array)\'');
    }
}
