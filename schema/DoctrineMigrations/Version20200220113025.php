<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200220113025 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE HuntGroupsRelUsers ADD routeType VARCHAR(25) NOT NULL COMMENT \'[enum:number|user]\', ADD numberValue VARCHAR(25) DEFAULT NULL, ADD numberCountryId INT UNSIGNED DEFAULT NULL, CHANGE userId userId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE HuntGroupsRelUsers ADD CONSTRAINT FK_79ED31ABD7819488 FOREIGN KEY (numberCountryId) REFERENCES Countries (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_79ED31ABD7819488 ON HuntGroupsRelUsers (numberCountryId)');
        $this->addSql('UPDATE HuntGroupsRelUsers SET routeType="user"');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE HuntGroupsRelUsers DROP FOREIGN KEY FK_79ED31ABD7819488');
        $this->addSql('DROP INDEX IDX_79ED31ABD7819488 ON HuntGroupsRelUsers');
        $this->addSql('ALTER TABLE HuntGroupsRelUsers DROP routeType, DROP numberValue, DROP numberCountryId, CHANGE userId userId INT UNSIGNED NOT NULL');
    }
}
