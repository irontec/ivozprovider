<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171103153932 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ast_queue_members');
        $this->addSql('CREATE VIEW ast_queue_members AS SELECT QM.id AS uniqueid, CONCAT("b", C.brandId, "c", C.id, "q", Q.id, "_", Q.name) AS queue_name, CONCAT("Local/", QM.id, "@queues") AS interface, CONCAT("b", C.brandId, "c", C.id, "q", Q.id, "m", QM.id) AS membername, CONCAT("PJSIP/", APE.sorcery_id) AS state_interface, QM.penalty FROM QueueMembers QM JOIN Users U ON U.id=QM.userId JOIN Queues Q ON Q.id=QM.queueId JOIN Terminals T ON T.id=U.terminalId JOIN ast_ps_endpoints APE ON APE.terminalId=T.id JOIN Companies C ON C.id=Q.companyId');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP VIEW ast_queue_members');
        $this->addSql('CREATE TABLE ast_queue_members (uniqueid INT UNSIGNED NOT NULL, queue_name VARCHAR(80) NOT NULL , interface VARCHAR(80) NOT NULL , membername VARCHAR(80) DEFAULT NULL , state_interface VARCHAR(80) DEFAULT NULL , penalty INT DEFAULT NULL, paused INT DEFAULT NULL, queueMemberId INT UNSIGNED DEFAULT NULL, INDEX queueMemberId (queueMemberId), PRIMARY KEY(uniqueid)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ast_queue_members ADD CONSTRAINT ast_queue_members_ibfk_1 FOREIGN KEY (queueMemberId) REFERENCES QueueMembers (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO ast_queue_members (uniqueid, queue_name, interface, membername, state_interface, penalty, paused, queueMemberId) SELECT QM.id AS uniqueid, CONCAT("b", C.brandId, "c", C.id, "q", Q.id, "_", Q.name) AS queue_name, CONCAT("Local/", QM.id, "@queues") AS interface, CONCAT("b", C.brandId, "c", C.id, "q", Q.id, "m", QM.id) AS membername, CONCAT("PJSIP/", APE.sorcery_id) AS state_interface, QM.penalty, NULL AS paused, QM.id AS queueMemberId FROM QueueMembers QM JOIN Users U ON U.id=QM.userId JOIN Queues Q ON Q.id=QM.queueId JOIN Terminals T ON T.id=U.terminalId JOIN ast_ps_endpoints APE ON APE.terminalId=T.id JOIN Companies C ON C.id=Q.companyId');
    }
}
