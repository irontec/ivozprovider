<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190618171752 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE t1 FROM kam_trunks_cdrs t1 INNER JOIN kam_trunks_cdrs t2 WHERE t1.id > t2.id AND t1.callid=t2.callid AND t1.direction=t2.direction');
        $this->addSql('CREATE UNIQUE INDEX trunksCdr_callid_direction ON kam_trunks_cdrs (callid, direction)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX trunksCdr_callid_direction ON kam_trunks_cdrs');
    }
}
