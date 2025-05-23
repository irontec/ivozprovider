<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250523094810 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add RoutingTag to DDIProviders and DDIs';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE DDIProviders ADD routingTagId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIProviders ADD CONSTRAINT FK_CA534EFDA48EA1F0 FOREIGN KEY (routingTagId) REFERENCES RoutingTags (id) ON DELETE RESTRICT');
        $this->addSql('CREATE INDEX IDX_CA534EFDA48EA1F0 ON DDIProviders (routingTagId)');
        $this->addSql('ALTER TABLE DDIs ADD useDdiProviderRoutingTag TINYINT(1) DEFAULT 1 NOT NULL, ADD routingTagId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT FK_AA16E1A0A48EA1F0 FOREIGN KEY (routingTagId) REFERENCES RoutingTags (id) ON DELETE RESTRICT');
        $this->addSql('CREATE INDEX IDX_AA16E1A0A48EA1F0 ON DDIs (routingTagId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE DDIProviders DROP FOREIGN KEY FK_CA534EFDA48EA1F0');
        $this->addSql('DROP INDEX IDX_CA534EFDA48EA1F0 ON DDIProviders');
        $this->addSql('ALTER TABLE DDIProviders DROP routingTagId');
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY FK_AA16E1A0A48EA1F0');
        $this->addSql('DROP INDEX IDX_AA16E1A0A48EA1F0 ON DDIs');
        $this->addSql('ALTER TABLE DDIs DROP useDdiProviderRoutingTag, DROP routingTagId');
    }
}
