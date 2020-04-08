<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190408170724 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends ADD interCompanyId INT UNSIGNED DEFAULT NULL, CHANGE directConnectivity directConnectivity VARCHAR(20) DEFAULT \'yes\' NOT NULL COMMENT \'[enum:yes|no|intervpbx]\'');
        $this->addSql('ALTER TABLE Friends ADD CONSTRAINT FK_EE5349F5B32E7B3A FOREIGN KEY (interCompanyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EE5349F5B32E7B3A ON Friends (interCompanyId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Friends DROP FOREIGN KEY FK_EE5349F5B32E7B3A');
        $this->addSql('DROP INDEX IDX_EE5349F5B32E7B3A ON Friends');
        $this->addSql('ALTER TABLE Friends DROP interCompanyId, CHANGE directConnectivity directConnectivity VARCHAR(255) DEFAULT \'yes\' NOT NULL COLLATE utf8_general_ci COMMENT \'[enum:yes|no]\'');
    }
}
