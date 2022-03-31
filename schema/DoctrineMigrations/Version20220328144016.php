<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328144016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ExternalCallFilters: Holidays and Schedulers toggles disabled by default';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ExternalCallFilters CHANGE outOfScheduleEnabled outOfScheduleEnabled TINYINT(1) UNSIGNED DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE ExternalCallFilters CHANGE holidayEnabled holidayEnabled TINYINT(1) UNSIGNED DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ExternalCallFilters CHANGE holidayEnabled holidayEnabled TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE ExternalCallFilters CHANGE outOfScheduleEnabled outOfScheduleEnabled TINYINT(1) DEFAULT \'1\' NOT NULL');
    }
}
