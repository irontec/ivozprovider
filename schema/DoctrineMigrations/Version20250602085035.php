<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250602085035 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Migrate ast_voicemail_messages data for asterisk 20.14.0';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE ast_voicemail_messages SET recording = "AUDMAGIC"');
    }

    public function down(Schema $schema): void
    {
    }
}