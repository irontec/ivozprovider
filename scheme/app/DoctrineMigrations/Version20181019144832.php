<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181019144832 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BillableCalls ADD endpointType VARCHAR(55) DEFAULT NULL, ADD endpointId INT UNSIGNED DEFAULT NULL');
        $this->addSql('CREATE INDEX billableCall_endpointType_idx ON BillableCalls (endpointType)');
        $this->addSql('CREATE INDEX billableCall_endpointId_idx ON BillableCalls (endpointId)');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD retailAccountId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB65EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_92E58EB65EA9D64D ON kam_trunks_cdrs (retailAccountId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX billableCall_endpointType_idx ON BillableCalls');
        $this->addSql('DROP INDEX billableCall_endpointId_idx ON BillableCalls');
        $this->addSql('ALTER TABLE BillableCalls DROP endpointType, DROP endpointId');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB65EA9D64D');
        $this->addSql('DROP INDEX IDX_92E58EB65EA9D64D ON kam_trunks_cdrs');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP retailAccountId');
    }
}
