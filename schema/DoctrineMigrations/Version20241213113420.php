<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20241213113420 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add applicationServersRelApplicationServersSet relation to kam_dispatcher';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE kam_dispatcher
           ADD applicationServerSetRelApplicationServersId INT UNSIGNED NOT NULL'
        );

        $this->dataMigration();
        $this->addSql('ALTER TABLE kam_dispatcher
            ADD CONSTRAINT FK_7CD78806A0936910 FOREIGN KEY (
                applicationServerSetRelApplicationServersId
            ) REFERENCES ApplicationServerSetRelApplicationServers (id) ON DELETE CASCADE'
        );
        $this->addSql('CREATE INDEX IDX_7CD78806A0936910 ON kam_dispatcher (
            applicationServerSetRelApplicationServersId
           )'
        );

        $this->dropApplicationServerId();
    }

    private function dataMigration(): void
    {
        $this->addSql('TRUNCATE TABLE kam_dispatcher');

        $this->addSql('
            INSERT INTO kam_dispatcher
            SELECT
                NULL as id, 
                SETS.id AS setid, 
                CONCAT("sip:", ASES.ip, ":6060") AS destination, 
                0 AS flags, 
                0 AS priority, 
                "" AS attrs, 
                ASES.name AS `description`, 
                ASES.id AS applicationServerId, 
                REL.id AS applicationServerSetRelApplicationServerId 
            FROM ApplicationServerSetRelApplicationServers REL
            JOIN ApplicationServers ASES ON ASES.id=REL.applicationServerId
            JOIN ApplicationServerSets SETS ON SETS.id=REL.applicationServerSetId'
        );
    }

    public function dropApplicationServerId(): void
    {
        $this->addSql('ALTER TABLE kam_dispatcher DROP FOREIGN KEY kam_dispatcher_ibfk_1');
        $this->addSql('DROP INDEX dispatcher_applicationServerId ON kam_dispatcher');
        $this->addSql('ALTER TABLE kam_dispatcher DROP applicationServerId');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE kam_dispatcher DROP FOREIGN KEY FK_7CD78806A0936910');
        $this->addSql('DROP INDEX IDX_7CD78806A0936910 ON kam_dispatcher');
        $this->addSql('ALTER TABLE kam_dispatcher DROP applicationServerSetRelApplicationServersId');

        $this->addApplicationServerId();
    }

    private function addApplicationServerId(): void
    {
        $this->addSql('ALTER TABLE kam_dispatcher ADD applicationServerId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE
          kam_dispatcher
        ADD
          CONSTRAINT kam_dispatcher_ibfk_1 FOREIGN KEY (applicationServerId) REFERENCES ApplicationServers (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX dispatcher_applicationServerId ON kam_dispatcher (applicationServerId)');
    }
}