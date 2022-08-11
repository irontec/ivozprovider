<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328101058 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Fixed enum field issues with current doctrine version';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'ALTER TABLE Domains
            CHANGE pointsTo pointsTo VARCHAR(25) DEFAULT \'proxyusers\' NOT NULL COMMENT \'[enum:proxyusers|proxytrunks]\''
        );
        $this->addSql(
            'ALTER TABLE FaxesInOut
            CHANGE status status VARCHAR(25) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci` COMMENT \'[enum:error|pending|inprogress|completed]\''
        );
        $this->addSql(
            'ALTER TABLE Friends
            CHANGE direct_media_method direct_media_method VARCHAR(25) CHARACTER SET utf8 DEFAULT \'update\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'[enum:invite|update]\', 
            CHANGE callerid_update_header callerid_update_header VARCHAR(10) CHARACTER SET utf8 DEFAULT \'pai\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'[enum:pai|rpid]\', 
            CHANGE update_callerid update_callerid VARCHAR(10) CHARACTER SET utf8 DEFAULT \'yes\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'[enum:yes|no]\''
        );
        $this->addSql(
            'ALTER TABLE OutgoingRouting
            CHANGE type type VARCHAR(25) CHARACTER SET utf8 DEFAULT \'group\' COLLATE `utf8_general_ci` COMMENT \'[enum:pattern|group|fax]\''
        );
        $this->addSql(
            'ALTER TABLE Queues
            CHANGE strategy strategy VARCHAR(25) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci` COMMENT \'[enum:ringall|leastrecent|fewestcalls|random|rrmemory|linear|wrandom|rrordered]\''
        );
        $this->addSql(
            'ALTER TABLE Recordings
            CHANGE type type VARCHAR(25) CHARACTER SET utf8 DEFAULT \'ddi\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'[enum:ondemand|ddi]\'');
        $this->addSql(
            'ALTER TABLE Terminals
            CHANGE direct_media_method direct_media_method VARCHAR(25) CHARACTER SET utf8 DEFAULT \'update\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'[enum:update|invite|reinvite]\''
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
