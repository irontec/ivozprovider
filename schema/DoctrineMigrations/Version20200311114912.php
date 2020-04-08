<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200311114912 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BillableCalls ADD ddiProviderId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD ddiProviderId INT UNSIGNED DEFAULT NULL');

        $this->addSql('CREATE INDEX IDX_E6F2DA3553615680 ON BillableCalls (ddiProviderId)');
        $this->addSql('CREATE INDEX IDX_92E58EB653615680 ON kam_trunks_cdrs (ddiProviderId)');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA3553615680 FOREIGN KEY (ddiProviderId) REFERENCES DDIProviders (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB653615680 FOREIGN KEY (ddiProviderId) REFERENCES DDIProviders (id) ON DELETE SET NULL');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB653615680');
        $this->addSql('DROP INDEX IDX_92E58EB653615680 ON kam_trunks_cdrs');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP ddiProviderId');

        $this->addSql('ALTER TABLE BillableCalls DROP FOREIGN KEY FK_E6F2DA3553615680');
        $this->addSql('DROP INDEX IDX_E6F2DA3553615680 ON BillableCalls');
        $this->addSql('ALTER TABLE BillableCalls DROP ddiProviderId');
    }
}
