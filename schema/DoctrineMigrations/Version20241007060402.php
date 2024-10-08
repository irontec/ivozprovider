<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20241007060402 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add applicationServerSet and mediaRelaySet rel to Company';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Companies ADD applicationServerSetId INT UNSIGNED NOT NULL, 
                            ADD mediaRelaySetId INT UNSIGNED NOT NULL');

        $this->addSql('UPDATE Companies SET applicationServerSetId = 0, mediaRelaySetId = 0');

        $this->addSql('ALTER TABLE Companies 
                            ADD CONSTRAINT FK_B52899C9049B0E FOREIGN KEY (applicationServerSetId) 
                            REFERENCES ApplicationServerSets (id) ON DELETE RESTRICT'
                            );
        $this->addSql('ALTER TABLE Companies
                            ADD CONSTRAINT FK_B52899ED1C657C FOREIGN KEY (mediaRelaySetId)
                            REFERENCES MediaRelaySets (id) ON DELETE RESTRICT');
        $this->addSql('CREATE INDEX IDX_B52899C9049B0E ON Companies (applicationServerSetId)');
        $this->addSql('CREATE INDEX IDX_B52899ED1C657C ON Companies (mediaRelaySetId)');

        $this->addSql('ALTER TABLE Carriers ADD mediaRelaySetId INT UNSIGNED NOT NULL');
        $this->addSql('UPDATE Carriers SET mediaRelaySetId = 0');
        $this->addSql('ALTER TABLE Carriers 
                            ADD CONSTRAINT FK_F63EC8E3ED1C657C FOREIGN KEY (mediaRelaySetId) 
                            REFERENCES MediaRelaySets (id) ON DELETE RESTRICT');
        $this->addSql('CREATE INDEX IDX_F63EC8E3ED1C657C ON Carriers (mediaRelaySetId)');

        $this->addSql('ALTER TABLE DDIProviders ADD mediaRelaySetId INT UNSIGNED NOT NULL');
        $this->addSql('UPDATE DDIProviders SET mediaRelaySetId = 0');
        $this->addSql('ALTER TABLE DDIProviders 
                            ADD CONSTRAINT FK_CA534EFDED1C657C FOREIGN KEY (mediaRelaySetId) 
                            REFERENCES MediaRelaySets (id) ON DELETE RESTRICT');
        $this->addSql('CREATE INDEX IDX_CA534EFDED1C657C ON DDIProviders (mediaRelaySetId)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899C9049B0E');
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899ED1C657C');
        $this->addSql('DROP INDEX IDX_B52899C9049B0E ON Companies');
        $this->addSql('DROP INDEX IDX_B52899ED1C657C ON Companies');
        $this->addSql('ALTER TABLE Companies DROP applicationServerSetId, DROP mediaRelaySetId');

        $this->addSql('ALTER TABLE Carriers DROP FOREIGN KEY FK_F63EC8E3ED1C657C');
        $this->addSql('DROP INDEX IDX_F63EC8E3ED1C657C ON Carriers');
        $this->addSql('ALTER TABLE Carriers DROP mediaRelaySetId');

        $this->addSql('ALTER TABLE DDIProviders DROP FOREIGN KEY FK_CA534EFDED1C657C');
        $this->addSql('DROP INDEX IDX_CA534EFDED1C657C ON DDIProviders');
        $this->addSql('ALTER TABLE DDIProviders DROP mediaRelaySetId');
    }
}