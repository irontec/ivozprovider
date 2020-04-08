<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200226175512 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BillableCalls ADD ddiId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD ddiId INT UNSIGNED DEFAULT NULL');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA3532B6E766 FOREIGN KEY (ddiId) REFERENCES DDIs (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB632B6E766 FOREIGN KEY (ddiId) REFERENCES DDIs (id) ON DELETE SET NULL');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');
        $this->addSql('CREATE INDEX IDX_E6F2DA3532B6E766 ON BillableCalls (ddiId)');
        $this->addSql('CREATE INDEX IDX_92E58EB632B6E766 ON kam_trunks_cdrs (ddiId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BillableCalls DROP FOREIGN KEY FK_E6F2DA3532B6E766');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB632B6E766');
        $this->addSql('DROP INDEX IDX_E6F2DA3532B6E766 ON BillableCalls');
        $this->addSql('DROP INDEX IDX_92E58EB632B6E766 ON kam_trunks_cdrs');
        $this->addSql('ALTER TABLE BillableCalls DROP ddiId');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP ddiId');
    }
}
