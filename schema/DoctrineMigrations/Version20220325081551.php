<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220325081551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE BalanceMovements CHANGE amount amount NUMERIC(10, 4) DEFAULT \'0.0000\', CHANGE balance balance NUMERIC(10, 4) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE BalanceNotifications CHANGE threshold threshold NUMERIC(10, 4) DEFAULT \'0.0000\'');
        $this->addSql('ALTER TABLE Carriers CHANGE balance balance NUMERIC(10, 4) DEFAULT \'0.0000\'');
        $this->addSql('ALTER TABLE Companies CHANGE balance balance NUMERIC(10, 4) DEFAULT \'0.0000\', CHANGE currentDayUsage currentDayUsage NUMERIC(10, 4) DEFAULT \'0.0000\'');
        $this->addSql('ALTER TABLE FixedCosts CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE RatingPlans CHANGE weight weight NUMERIC(8, 2) DEFAULT \'10.00\' NOT NULL');
        $this->addSql('ALTER TABLE Recordings CHANGE duration duration DOUBLE PRECISION DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE kam_users_location CHANGE q q DOUBLE PRECISION DEFAULT \'1.00\' NOT NULL');
        $this->addSql('ALTER TABLE tp_destination_rates CHANGE max_cost max_cost NUMERIC(10, 4) DEFAULT \'0.0000\' NOT NULL');
        $this->addSql('ALTER TABLE tp_lcr_rules CHANGE weight weight NUMERIC(8, 2) DEFAULT \'10.00\' NOT NULL');
        $this->addSql('ALTER TABLE tp_rating_plans CHANGE weight weight NUMERIC(8, 2) DEFAULT \'10.00\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE BalanceMovements CHANGE amount amount NUMERIC(10, 4) DEFAULT \'0.0000\', CHANGE balance balance NUMERIC(10, 4) DEFAULT \'0.0000\'');
        $this->addSql('ALTER TABLE BalanceNotifications CHANGE threshold threshold NUMERIC(10, 4) DEFAULT \'0.0000\'');
        $this->addSql('ALTER TABLE Carriers CHANGE balance balance NUMERIC(10, 4) DEFAULT \'0.0000\'');
        $this->addSql('ALTER TABLE Companies CHANGE balance balance NUMERIC(10, 4) DEFAULT \'0.0000\'');
        $this->addSql('ALTER TABLE FixedCosts CHANGE description description TINYTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE RatingPlans CHANGE weight weight NUMERIC(8, 2) DEFAULT \'10.00\' NOT NULL, CHANGE timing_type timing_type VARCHAR(10) CHARACTER SET utf8 DEFAULT \'always\' COLLATE utf8_general_ci COMMENT \'[enum:always|custom]\'');
        $this->addSql('ALTER TABLE Recordings CHANGE duration duration DOUBLE PRECISION DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE kam_users_location CHANGE q q DOUBLE PRECISION DEFAULT \'1.00\' NOT NULL');
        $this->addSql('ALTER TABLE tp_destination_rates CHANGE max_cost max_cost NUMERIC(10, 4) DEFAULT \'0.0000\' NOT NULL');
        $this->addSql('ALTER TABLE tp_lcr_rules CHANGE weight weight NUMERIC(8, 2) DEFAULT \'10.00\' NOT NULL');
        $this->addSql('ALTER TABLE tp_rating_plans CHANGE weight weight NUMERIC(8, 2) DEFAULT \'10.00\' NOT NULL');
    }
}
