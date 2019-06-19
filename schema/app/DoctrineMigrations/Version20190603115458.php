<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190603115458 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE INDEX billableCall_direction_idx ON BillableCalls (direction)');
        $this->addSql('CREATE INDEX tpCdr_originId_idx ON tp_cdrs (origin_id)');
        $this->addSql('CREATE INDEX tpCdr_cgrid_idx ON tp_cdrs (cgrid)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX billableCall_direction_idx ON BillableCalls');
        $this->addSql('DROP INDEX tpCdr_originId_idx ON tp_cdrs');
        $this->addSql('DROP INDEX tpCdr_cgrid_idx ON tp_cdrs');
    }
}
