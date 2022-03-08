<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303101103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add CallForwardSettings fields for Friend endpoints';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE CallForwardSettings ADD friendId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CallForwardSettings ADD CONSTRAINT FK_E71B58A4893BA339 FOREIGN KEY (friendId) REFERENCES Friends (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_E71B58A4893BA339 ON CallForwardSettings (friendId)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE CallForwardSettings DROP FOREIGN KEY FK_E71B58A4893BA339');
        $this->addSql('DROP INDEX IDX_E71B58A4893BA339 ON CallForwardSettings');
        $this->addSql('ALTER TABLE CallForwardSettings DROP friendId');
    }
}
