<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250311150116 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add new survival device table';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE SurvivalDevices (
            id INT UNSIGNED AUTO_INCREMENT NOT NULL, 
            name VARCHAR(80) NOT NULL, proxy VARCHAR(80) NOT NULL, 
            outboundProxy VARCHAR(80) DEFAULT NULL, 
            udpPort INT UNSIGNED DEFAULT 5060 NOT NULL, 
            tcpPort INT UNSIGNED DEFAULT 5060 NOT NULL, 
            tlsPort INT UNSIGNED DEFAULT 5061 NOT NULL, 
            wssPort INT UNSIGNED DEFAULT 10081 NOT NULL, 
            description VARCHAR(1024) DEFAULT NULL, 
            companyId INT UNSIGNED NOT NULL, 
            INDEX IDX_686068562480E723 (companyId), 
            UNIQUE INDEX name_company (name, companyId), 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE SurvivalDevices ADD CONSTRAINT FK_686068562480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE SurvivalDevices');
    }
}