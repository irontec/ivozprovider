<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722100925 extends LoggableMigration
{
    public function isTransactional() : bool
    {
        return false;
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ast_ps_identify (
                id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                sorcery_id VARCHAR(40) NOT NULL,
                endpoint VARCHAR(40) DEFAULT NULL,
                `match` VARCHAR(80) DEFAULT NULL,
                match_header VARCHAR(100) DEFAULT NULL,
                srv_lookups VARCHAR(10) DEFAULT \'false\' NOT NULL,
                terminalId INT UNSIGNED DEFAULT NULL,
                friendId INT UNSIGNED DEFAULT NULL,
                residentialDeviceId INT UNSIGNED DEFAULT NULL,
                retailAccountId INT UNSIGNED DEFAULT NULL,
            INDEX psIdentify_sorcery_idx (sorcery_id),
            UNIQUE INDEX psIdentify_terminal (terminalId),
            UNIQUE INDEX psIdentify_friend (friendId),
            UNIQUE INDEX psIdentify_residential_device (residentialDeviceId),
            UNIQUE INDEX psIdentify_retail_account (retailAccountId),
            PRIMARY KEY(id))
            DEFAULT CHARACTER SET UTF8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ast_ps_identify ADD CONSTRAINT FK_B74E7CACAE025626 FOREIGN KEY (terminalId) REFERENCES Terminals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ast_ps_identify ADD CONSTRAINT FK_B74E7CAC893BA339 FOREIGN KEY (friendId) REFERENCES Friends (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ast_ps_identify ADD CONSTRAINT FK_B74E7CAC8B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ast_ps_identify ADD CONSTRAINT FK_B74E7CAC5EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO ast_ps_identify (
                sorcery_id,
                endpoint,
                match_header,
                terminalId,
                friendId,
                residentialDeviceId,
                retailAccountId
            ) SELECT
                sorcery_id,
                sorcery_id,
                CONCAT("X-Info-Endpoint: " , sorcery_id),
                terminalId,
                friendId,
                residentialDeviceId,
                retailAccountId
            FROM ast_ps_endpoints');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ast_ps_identify');
    }
}
