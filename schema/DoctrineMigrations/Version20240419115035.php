<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240419115035 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add VoicemailRelUsers entity';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE VoicemailRelUsers (id INT UNSIGNED AUTO_INCREMENT NOT NULL, userId INT UNSIGNED NOT NULL, voicemailId INT UNSIGNED NOT NULL, INDEX IDX_56929D8E64B64DCC (userId), UNIQUE INDEX voicemailRelUser_voicemail_user (voicemailId, userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE VoicemailRelUsers ADD CONSTRAINT FK_56929D8E64B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE VoicemailRelUsers ADD CONSTRAINT FK_56929D8E56691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE VoicemailRelUsers');
    }
}
