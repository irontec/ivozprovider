<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200227160910 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX CallCsvScheduler_name_brand ON CallCsvSchedulers');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD ddiId INT UNSIGNED DEFAULT NULL, ADD carrierId INT UNSIGNED DEFAULT NULL, ADD retailAccountId INT UNSIGNED DEFAULT NULL, ADD residentialDeviceId INT UNSIGNED DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_100E171E32B6E766 ON CallCsvSchedulers (ddiId)');
        $this->addSql('CREATE INDEX IDX_100E171E6709B1C ON CallCsvSchedulers (carrierId)');
        $this->addSql('CREATE INDEX IDX_100E171E5EA9D64D ON CallCsvSchedulers (retailAccountId)');
        $this->addSql('CREATE INDEX IDX_100E171E8B329DCD ON CallCsvSchedulers (residentialDeviceId)');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E32B6E766 FOREIGN KEY (ddiId) REFERENCES DDIs (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E6709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E5EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E8B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX CallCsvScheduler_brand_name ON CallCsvSchedulers (brandId, name)');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP INDEX IDX_100E171E9CBEC244');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers DROP FOREIGN KEY FK_100E171E32B6E766');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP FOREIGN KEY FK_100E171E6709B1C');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP FOREIGN KEY FK_100E171E5EA9D64D');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP FOREIGN KEY FK_100E171E8B329DCD');
        $this->addSql('DROP INDEX IDX_100E171E32B6E766 ON CallCsvSchedulers');
        $this->addSql('DROP INDEX IDX_100E171E6709B1C ON CallCsvSchedulers');
        $this->addSql('DROP INDEX IDX_100E171E5EA9D64D ON CallCsvSchedulers');
        $this->addSql('DROP INDEX IDX_100E171E8B329DCD ON CallCsvSchedulers');
        $this->addSql('CREATE INDEX IDX_100E171E9CBEC244 ON CallCsvSchedulers (brandId)');
        $this->addSql('DROP INDEX CallCsvScheduler_brand_name ON CallCsvSchedulers');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP ddiId, DROP carrierId, DROP retailAccountId, DROP residentialDeviceId');
        $this->addSql('CREATE UNIQUE INDEX CallCsvScheduler_name_brand ON CallCsvSchedulers (name, brandId)');
    }
}
