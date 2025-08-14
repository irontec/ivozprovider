<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250716102539 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Adds locutionId to DDIs and Extensions tables and modifies routeType column';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE DDIs ADD locutionId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|conditional|residential|retail|locution]\'');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT FK_AA16E1A054690B0 FOREIGN KEY (locutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AA16E1A054690B0 ON DDIs (locutionId)');
        $this->addSql('ALTER TABLE Extensions ADD locutionId INT UNSIGNED DEFAULT NULL, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|ivr|huntGroup|conferenceRoom|friend|queue|conditional|voicemail|locution]\'');
        $this->addSql('ALTER TABLE Extensions ADD CONSTRAINT FK_9AAD9F7954690B0 FOREIGN KEY (locutionId) REFERENCES Locutions (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_9AAD9F7954690B0 ON Extensions (locutionId)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY FK_AA16E1A054690B0');
        $this->addSql('DROP INDEX IDX_AA16E1A054690B0 ON DDIs');
        $this->addSql('ALTER TABLE DDIs DROP locutionId, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|conditional|residential|retail]\'');
        $this->addSql('ALTER TABLE Extensions DROP FOREIGN KEY FK_9AAD9F7954690B0');
        $this->addSql('DROP INDEX IDX_9AAD9F7954690B0 ON Extensions');
        $this->addSql('ALTER TABLE Extensions DROP locutionId, CHANGE routeType routeType VARCHAR(25) DEFAULT NULL COMMENT \'[enum:user|number|ivr|huntGroup|conferenceRoom|friend|queue|conditional|voicemail]\'');
    }
}