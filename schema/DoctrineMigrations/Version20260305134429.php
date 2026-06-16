<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20260305134429 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add matchPattern column to MatchListPatterns';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE MatchListPatterns ADD matchPattern VARCHAR(255) DEFAULT \'\'');
        $this->addSql('UPDATE MatchListPatterns SET matchPattern = `regExp` WHERE type = "regexp" AND `regExp` IS NOT NULL');
        $this->addSql('UPDATE MatchListPatterns mlp JOIN Countries c ON mlp.numberCountryId = c.id SET mlp.matchPattern = CONCAT(c.countryCode, " ", mlp.numberValue) WHERE mlp.type = "number" AND mlp.numberValue IS NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE MatchListPatterns DROP matchPattern');
    }
}
