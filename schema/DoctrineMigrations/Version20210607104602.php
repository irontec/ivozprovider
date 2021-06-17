<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20210607104602 extends LoggableMigration
{
    public function isTransactional() : bool
    {
        return false;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DDIProviders ADD mediaRelaySetsId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIProviders ADD CONSTRAINT FK_CA534EFDC8555117 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_CA534EFDC8555117 ON DDIProviders (mediaRelaySetsId)');

        $this->addSql('ALTER TABLE Carriers ADD mediaRelaySetsId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Carriers ADD CONSTRAINT FK_F63EC8E3C8555117 FOREIGN KEY (mediaRelaySetsId) REFERENCES MediaRelaySets (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_F63EC8E3C8555117 ON Carriers (mediaRelaySetsId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Carriers DROP FOREIGN KEY FK_F63EC8E3C8555117');
        $this->addSql('DROP INDEX IDX_F63EC8E3C8555117 ON Carriers');
        $this->addSql('ALTER TABLE Carriers DROP mediaRelaySetsId');

        $this->addSql('ALTER TABLE DDIProviders DROP FOREIGN KEY FK_CA534EFDC8555117');
        $this->addSql('DROP INDEX IDX_CA534EFDC8555117 ON DDIProviders');
        $this->addSql('ALTER TABLE DDIProviders DROP mediaRelaySetsId');
    }
}
