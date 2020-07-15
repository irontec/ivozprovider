<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200715110449 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers ADD ddiProviderId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E53615680 FOREIGN KEY (ddiProviderId) REFERENCES DDIProviders (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_100E171E53615680 ON CallCsvSchedulers (ddiProviderId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers DROP FOREIGN KEY FK_100E171E53615680');
        $this->addSql('DROP INDEX IDX_100E171E53615680 ON CallCsvSchedulers');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP ddiProviderId');
    }
}
