<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180717150551 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX grp ON kam_trunks_address');
        $this->addSql('ALTER TABLE kam_trunks_address ADD ddiProviderAddressId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE kam_trunks_address ADD CONSTRAINT FK_873EF06250736B8 FOREIGN KEY (ddiProviderAddressId) REFERENCES DDIProviderAddresses (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_873EF06250736B8 ON kam_trunks_address (ddiProviderAddressId)');
        $this->addSql('INSERT INTO kam_trunks_address (grp, ip_addr, ddiProviderAddressId) SELECT ddiProviderId, ip, id FROM DDIProviderAddresses');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_address DROP FOREIGN KEY FK_873EF06250736B8');
        $this->addSql('DROP INDEX UNIQ_873EF06250736B8 ON kam_trunks_address');
        $this->addSql('ALTER TABLE kam_trunks_address DROP ddiProviderAddressId');
        $this->addSql('CREATE UNIQUE INDEX grp ON kam_trunks_address (grp)');
    }
}
