<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200127164702 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX billableCall_endpointType_idx ON BillableCalls');
        $this->addSql('DROP INDEX billableCall_endpointId_idx ON BillableCalls');
        $this->addSql('DROP INDEX billableCall_direction_idx ON BillableCalls');
        $this->addSql('DROP INDEX trunksCdr_start_time_idx ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX trunksCdr_end_time_idx ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX trunksCdr_xcallid_idx ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX trunksCdr_direction_idx ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX trunksCdr_cgrid_idx ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX usersCdr_end_time_idx ON kam_users_cdrs');
        $this->addSql('DROP INDEX usersCdr_xcallid_idx ON kam_users_cdrs');
        $this->addSql('DROP INDEX usersCdr_direction ON kam_users_cdrs');
        $this->addSql('DROP INDEX usersCdr_start_time_idx ON kam_users_cdrs');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE INDEX billableCall_endpointType_idx ON BillableCalls (endpointType)');
        $this->addSql('CREATE INDEX billableCall_endpointId_idx ON BillableCalls (endpointId)');
        $this->addSql('CREATE INDEX billableCall_direction_idx ON BillableCalls (direction)');
        $this->addSql('CREATE INDEX trunksCdr_start_time_idx ON kam_trunks_cdrs (start_time)');
        $this->addSql('CREATE INDEX trunksCdr_end_time_idx ON kam_trunks_cdrs (end_time)');
        $this->addSql('CREATE INDEX trunksCdr_xcallid_idx ON kam_trunks_cdrs (xcallid)');
        $this->addSql('CREATE INDEX trunksCdr_direction_idx ON kam_trunks_cdrs (direction)');
        $this->addSql('CREATE INDEX trunksCdr_cgrid_idx ON kam_trunks_cdrs (cgrid)');
        $this->addSql('CREATE INDEX usersCdr_end_time_idx ON kam_users_cdrs (end_time)');
        $this->addSql('CREATE INDEX usersCdr_xcallid_idx ON kam_users_cdrs (xcallid)');
        $this->addSql('CREATE INDEX usersCdr_direction ON kam_users_cdrs (direction)');
        $this->addSql('CREATE INDEX usersCdr_start_time_idx ON kam_users_cdrs (start_time)');
    }
}
