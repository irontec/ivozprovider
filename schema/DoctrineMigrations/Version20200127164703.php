<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200127164703 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE INDEX usersCdr_companyId_hidden_startTime ON kam_users_cdrs (companyId, hidden, start_time)');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX userscdr_companyid TO IDX_238F735B2480E723');
        $this->addSql('CREATE INDEX changelog_entity_createdOn ON Changelog (entity, createdOn)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX usersCdr_companyId_hidden_startTime ON kam_users_cdrs');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX idx_238f735b2480e723 TO usersCdr_companyId');
        $this->addSql('DROP INDEX changelog_entity_createdOn ON Changelog');
    }
}
