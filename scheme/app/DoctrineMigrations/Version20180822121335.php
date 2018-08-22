<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180822121335 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tp_destinations ADD routingPatternId INT UNSIGNED DEFAULT NULL, CHANGE destinationId destinationId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE tp_destinations ADD CONSTRAINT FK_C98068856D661974 FOREIGN KEY (routingPatternId) REFERENCES RoutingPatterns (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C98068856D661974 ON tp_destinations (routingPatternId)');

        // Create Destination Rates for existing RoutingPatterns
        $this->addSql('INSERT INTO tp_destinations (tag, prefix, routingPatternId) SELECT CONCAT("b", brandId, "lcrdst", id), prefix, id FROM RoutingPatterns');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Remove Routing pattern's tp_destinations
        $this->addSql('DELETE FROM tp_destinations WHERE routingPatternId IS NOT NULL');

        $this->addSql('ALTER TABLE tp_destinations DROP FOREIGN KEY FK_C98068856D661974');
        $this->addSql('DROP INDEX UNIQ_C98068856D661974 ON tp_destinations');
        $this->addSql('ALTER TABLE tp_destinations DROP routingPatternId, CHANGE destinationId destinationId INT UNSIGNED NOT NULL');
    }
}
