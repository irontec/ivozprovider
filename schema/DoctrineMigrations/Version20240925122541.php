<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240925122541 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add ApplicationServerSet and ApplicationServerSetRelApplicationServer';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE ApplicationServerSets (
                                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                name VARCHAR(32) DEFAULT \'\' NOT NULL,
                                distributeMethod VARCHAR(25) DEFAULT \'hash\' NOT NULL COMMENT \'[enum:rr|hash]\',
                                description VARCHAR(200) DEFAULT NULL,
                                UNIQUE INDEX applicationServerSet_name (name),
                                PRIMARY KEY(id))                                 
                            DEFAULT CHARACTER SET utf8mb4
                            COLLATE `utf8mb4_unicode_ci`
                            ENGINE = InnoDB'
        );

        $this->addSql('CREATE TABLE ApplicationServerSetRelApplicationServers (
                                id INT UNSIGNED NOT NULL AUTO_INCREMENT, 
                                applicationServerId INT UNSIGNED DEFAULT NULL, 
                                applicationServerSetId INT UNSIGNED DEFAULT NULL, 
                                INDEX IDX_52382C15C9049B0E (applicationServerSetId),
                                UNIQUE INDEX application_server_set_rel (applicationServerId, applicationServerSetId),
                                PRIMARY KEY(id))                                 
                            DEFAULT CHARACTER SET utf8mb4 
                            COLLATE `utf8mb4_unicode_ci` 
                            ENGINE = InnoDB'
        );

        $this->addSql('ALTER TABLE ApplicationServerSetRelApplicationServers
                           ADD CONSTRAINT FK_52382C15F862FFE7
                           FOREIGN KEY (applicationServerId) REFERENCES ApplicationServers (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE ApplicationServerSetRelApplicationServers
                           ADD CONSTRAINT FK_52382C15C9049B0E
                           FOREIGN KEY (applicationServerSetId) REFERENCES ApplicationServerSets (id) ON DELETE CASCADE');

        $this->createDefaultSet();
    }

    private function createDefaultSet(): void
    {
        $this->addSql('SET SESSION sql_mode=\'NO_AUTO_VALUE_ON_ZERO\'');
        $this->addSql('INSERT INTO ApplicationServerSets VALUES(0, "default", "hash", "Default application server set")');
        $this->addSql('INSERT INTO ApplicationServerSetRelApplicationServers(applicationServerId, applicationServerSetId) 
                            SELECT id, 0 as applicationServerSetId FROM ApplicationServers');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ApplicationServerSetRelApplicationServers DROP FOREIGN KEY FK_52382C15C9049B0E');
        $this->addSql('DROP TABLE ApplicationServerSetRelApplicationServers');
        $this->addSql('DROP TABLE ApplicationServerSets');
    }
}
