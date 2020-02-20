<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180813131742 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Carriers ADD calculateCost TINYINT(1) unsigned DEFAULT \'0\'');
        $this->addSql('ALTER TABLE tp_derived_chargers MODIFY `req_type_field` varchar(64) NOT NULL DEFAULT \'carrierReqtype\'');
        $this->addSql("UPDATE tp_derived_chargers SET req_type_field='carrierReqtype'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("UPDATE tp_derived_chargers SET req_type_field='^*postpaid'");
        $this->addSql('ALTER TABLE tp_derived_chargers MODIFY `req_type_field` varchar(64) NOT NULL DEFAULT \'^*postpaid\'');
        $this->addSql('ALTER TABLE Carriers DROP calculateCost');
    }
}
