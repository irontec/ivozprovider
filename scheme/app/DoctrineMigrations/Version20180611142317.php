<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180611142317 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE IVREntries DROP FOREIGN KEY FK_E847DD7C12AB7F65');
        $this->addSql('ALTER TABLE IVREntries DROP FOREIGN KEY FK_E847DD7C9E2CE667');
        $this->addSql('ALTER TABLE IVREntries DROP FOREIGN KEY FK_E847DD7CAF230FFD');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7C12AB7F65 FOREIGN KEY (extensionId) REFERENCES Extensions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7C9E2CE667 FOREIGN KEY (conditionalRouteId) REFERENCES ConditionalRoutes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7CAF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE IVREntries DROP FOREIGN KEY FK_E847DD7C12AB7F65');
        $this->addSql('ALTER TABLE IVREntries DROP FOREIGN KEY FK_E847DD7CAF230FFD');
        $this->addSql('ALTER TABLE IVREntries DROP FOREIGN KEY FK_E847DD7C9E2CE667');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7C12AB7F65 FOREIGN KEY (extensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7CAF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE IVREntries ADD CONSTRAINT FK_E847DD7C9E2CE667 FOREIGN KEY (conditionalRouteId) REFERENCES ConditionalRoutes (id) ON DELETE SET NULL');
    }
}
