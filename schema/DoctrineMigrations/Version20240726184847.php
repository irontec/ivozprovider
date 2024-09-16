<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240726184847 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add ddi and user relations to Recordings';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Recordings ADD ddiId INT UNSIGNED DEFAULT NULL, ADD userId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Recordings ADD CONSTRAINT FK_A68A9FBE32B6E766 FOREIGN KEY (ddiId) REFERENCES DDIs (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Recordings ADD CONSTRAINT FK_A68A9FBE64B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A68A9FBE32B6E766 ON Recordings (ddiId)');
        $this->addSql('CREATE INDEX IDX_A68A9FBE64B64DCC ON Recordings (userId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Recordings DROP FOREIGN KEY FK_A68A9FBE32B6E766');
        $this->addSql('ALTER TABLE Recordings DROP FOREIGN KEY FK_A68A9FBE64B64DCC');
        $this->addSql('DROP INDEX IDX_A68A9FBE32B6E766 ON Recordings');
        $this->addSql('DROP INDEX IDX_A68A9FBE64B64DCC ON Recordings');
        $this->addSql('ALTER TABLE Recordings DROP ddiId, DROP userId');
    }
}