<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520060237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change Voicemail User and Residential constraints to ON DELETE CASCADE';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Voicemails DROP FOREIGN KEY FK_5CE3741564B64DCC');
        $this->addSql('ALTER TABLE Voicemails DROP FOREIGN KEY FK_5CE374158B329DCD');
        $this->addSql('ALTER TABLE Voicemails ADD CONSTRAINT FK_5CE3741564B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Voicemails ADD CONSTRAINT FK_5CE374158B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Voicemails DROP FOREIGN KEY FK_5CE3741564B64DCC');
        $this->addSql('ALTER TABLE Voicemails DROP FOREIGN KEY FK_5CE374158B329DCD');
        $this->addSql('ALTER TABLE Voicemails ADD CONSTRAINT FK_5CE3741564B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Voicemails ADD CONSTRAINT FK_5CE374158B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON UPDATE NO ACTION ON DELETE SET NULL');
    }
}
