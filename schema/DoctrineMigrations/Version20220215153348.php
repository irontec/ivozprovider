<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20220215153348 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallForwardSettings ADD friendId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CallForwardSettings ADD CONSTRAINT FK_E71B58A4893BA339 FOREIGN KEY (friendId) REFERENCES Friends (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_E71B58A4893BA339 ON CallForwardSettings (friendId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallForwardSettings DROP FOREIGN KEY FK_E71B58A4893BA339');
        $this->addSql('DROP INDEX IDX_E71B58A4893BA339 ON CallForwardSettings');
        $this->addSql('ALTER TABLE CallForwardSettings DROP friendId');
    }
}
