<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20241028083130 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Remove obsolete fields';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Carriers DROP FOREIGN KEY FK_F63EC8E3C8555117');
        $this->addSql('DROP INDEX IDX_F63EC8E3C8555117 ON Carriers');
        $this->addSql('ALTER TABLE Carriers DROP mediaRelaySetsId');

        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899C8555117');
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY Companies_ibfk_5');
        $this->addSql('DROP INDEX IDX_B52899F862FFE7 ON Companies');
        $this->addSql('DROP INDEX IDX_B52899C8555117 ON Companies');
        $this->addSql('ALTER TABLE Companies DROP applicationServerId, DROP mediaRelaySetsId');

        $this->addSql('ALTER TABLE DDIProviders DROP FOREIGN KEY FK_CA534EFDC8555117');
        $this->addSql('DROP INDEX IDX_CA534EFDC8555117 ON DDIProviders');
        $this->addSql('ALTER TABLE DDIProviders DROP mediaRelaySetsId');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Carriers ADD mediaRelaySetsId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Carriers ADD CONSTRAINT FK_F63EC8E3C8555117 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_F63EC8E3C8555117 ON Carriers (mediaRelaySetsId)');

        $this->addSql('ALTER TABLE Companies ADD applicationServerId INT UNSIGNED DEFAULT NULL, ADD mediaRelaySetsId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B52899C8555117 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT Companies_ibfk_5 FOREIGN KEY (applicationServerId) REFERENCES ApplicationServers (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B52899F862FFE7 ON Companies (applicationServerId)');
        $this->addSql('CREATE INDEX IDX_B52899C8555117 ON Companies (mediaRelaySetsId)');

        $this->addSql('ALTER TABLE DDIProviders ADD mediaRelaySetsId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIProviders ADD CONSTRAINT FK_CA534EFDC8555117 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_CA534EFDC8555117 ON DDIProviders (mediaRelaySetsId)');
    }
}