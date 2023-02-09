<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329110601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Voicemail Messages tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE VoicemailMessages (
                            id INT AUTO_INCREMENT NOT NULL,
                            calldate DATETIME NOT NULL,
                            folder VARCHAR(64) NOT NULL,
                            caller VARCHAR(128) DEFAULT NULL,
                            duration INT DEFAULT NULL,
                            recordingFileFileSize INT UNSIGNED DEFAULT NULL COMMENT \'[FSO:keepExtension]\',
                            recordingFileMimeType VARCHAR(80) DEFAULT NULL,
                            recordingFileBaseName VARCHAR(255) DEFAULT NULL,
                            metadataFileFileSize INT UNSIGNED DEFAULT NULL COMMENT \'[FSO:keepExtension]\',
                            metadataFileMimeType VARCHAR(80) DEFAULT NULL,
                            metadataFileBaseName VARCHAR(255) DEFAULT NULL,
                            voicemailId INT UNSIGNED DEFAULT NULL,
                            astVoicemailMessageId INT DEFAULT NULL,
                        INDEX IDX_B31F1B0F56691CFD (voicemailId),
                        INDEX IDX_B31F1B0F659CD68 (astVoicemailMessageId),
                        PRIMARY KEY(id))
                        DEFAULT CHARACTER SET UTF8
                        ENGINE = InnoDB'
        );
        $this->addSql('CREATE TABLE ast_voicemail_messages (
                            id INT AUTO_INCREMENT NOT NULL,
                            dir VARCHAR(255) NOT NULL,
                            msgnum INT NOT NULL DEFAULT 0,
                            context VARCHAR(80) DEFAULT NULL,
                            macrocontext VARCHAR(80) DEFAULT NULL,
                            callerid VARCHAR(80) DEFAULT NULL,
                            origtime INT NOT NULL DEFAULT 0,
                            duration INT NOT NULL DEFAULT 0,
                            recording VARCHAR(255) DEFAULT NULL,
                            flag VARCHAR(30) DEFAULT NULL,
                            category VARCHAR(30) DEFAULT NULL,
                            mailboxuser VARCHAR(30) NOT NULL,
                            mailboxcontext VARCHAR(30) NOT NULL,
                            msg_id VARCHAR(40) DEFAULT NULL,
                            parsed TINYINT(1) NOT NULL DEFAULT \'0\',
                        PRIMARY KEY(id))
                        DEFAULT CHARACTER SET UTF8
                        ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE VoicemailMessages ADD CONSTRAINT FK_B31F1B0F56691CFD FOREIGN KEY (voicemailId) REFERENCES Voicemails (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE VoicemailMessages ADD CONSTRAINT FK_B31F1B0F659CD68 FOREIGN KEY (astVoicemailMessageId) REFERENCES ast_voicemail_messages (id) ON DELETE CASCADE');

        // Add Administrator ACLs for VoicemailMessage entity
        $this->addSql("INSERT INTO PublicEntities (
                            iden, fqdn, platform, brand, client,
                            name_en, name_es, name_ca, name_it
                        ) VALUES (
                            'VoicemailMessages', 'Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessage', 0, 0, 1,
                            'VoicemailMessages', 'Mensajes de Buzón de Voz', 'VoicemailMessages', 'VoicemailMessages'
                        )"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE VoicemailMessages DROP FOREIGN KEY FK_B31F1B0F659CD68');
        $this->addSql('DROP TABLE VoicemailMessages');
        $this->addSql('DROP TABLE ast_voicemail_messages');
    }
}
