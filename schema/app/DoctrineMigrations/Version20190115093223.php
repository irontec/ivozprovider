<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190115093223 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallForwardSettings ADD retailAccountId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CallForwardSettings ADD CONSTRAINT FK_E71B58A45EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_E71B58A45EA9D64D ON CallForwardSettings (retailAccountId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallForwardSettings DROP FOREIGN KEY FK_E71B58A45EA9D64D');
        $this->addSql('DROP INDEX IDX_E71B58A45EA9D64D ON CallForwardSettings');
        $this->addSql('ALTER TABLE CallForwardSettings DROP retailAccountId');
    }
}
