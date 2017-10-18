<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170901153220 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `kam_acc_cdrs` MODIFY `meteringDate` datetime DEFAULT NULL');
        $this->addSql('UPDATE `kam_acc_cdrs` SET `meteringDate` = NULL WHERE `meteringDate` < "1000-01-01 00:00:00"');
        $this->addSql('ALTER TABLE `FaxesInOut` CHANGE `calldate` `calldate` DATETIME NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
