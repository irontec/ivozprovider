<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190410082735 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BillableCalls ADD direction VARCHAR(255) DEFAULT \'outbound\' COMMENT \'[enum:inbound|outbound]\'');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD callDirection VARCHAR(255) DEFAULT \'outbound\' COMMENT \'[enum:inbound|outbound]\'');

        // Do not migrate inbound call from the past
        $this->addSql('UPDATE kam_trunks_cdrs set parsed = 1 WHERE parsed = 0 and direction = \'inbound\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers DROP callDirection');
        $this->addSql('ALTER TABLE BillableCalls DROP direction');
    }
}
