<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124151016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'New Client toggle: rateCalls';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Companies ADD rateCalls TINYINT(1) DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE DDIs DROP type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Companies DROP rateCalls');
        $this->addSql('ALTER TABLE DDIs ADD type VARCHAR(25) DEFAULT \'inout\' NOT NULL COMMENT \'[enum:inout|out]\'');
    }
}
