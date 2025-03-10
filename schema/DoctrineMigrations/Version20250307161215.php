<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250307161215 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add new survival gear table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE SurvivalDevices (
            id INT UNSIGNED AUTO_INCREMENT NOT NULL, 
            name VARCHAR(80) NOT NULL, 
            proxy VARCHAR(80) NOT NULL, 
            outboundProxy VARCHAR(80) DEFAULT NULL, 
            udpPort INT(10) UNSIGNED NOT NULL DEFAULT 5060, 
            tcpPort INT(10) UNSIGNED NOT NULL DEFAULT 5060, 
            tlsPort INT(10) UNSIGNED NOT NULL DEFAULT 5061, 
            wssPort INT(10) UNSIGNED NOT NULL DEFAULT 10081, 
            description VARCHAR(1024) DEFAULT NULL, 
            companyId INT UNSIGNED NOT NULL, 
            PRIMARY KEY(id), 
            UNIQUE KEY name_company (name, companyId), 
            CONSTRAINT SurvivalDevices_ibfk_1 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE SurvivalDevices');
    }
}