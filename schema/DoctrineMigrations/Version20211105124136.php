<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211105124136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Administrators ADD internal TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql(
            'INSERT INTO `Administrators` (`username`, `pass`, `active`, `internal`, `brandId`) SELECT CONCAT("__b", id, "_internal"), "[internal]", 0, 1, `id` FROM `Brands`'
        );
        $this->addSql(
            'INSERT INTO `Administrators` (`username`, `pass`, `active`, `internal`, `brandId`, `companyId`) SELECT CONCAT("__c", id, "_internal"), "[internal]", 0, 1, `brandId`, `id` FROM `Companies`'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM `Administrators` where `internal` = 1');
        $this->addSql('ALTER TABLE Administrators DROP internal');
    }
}
