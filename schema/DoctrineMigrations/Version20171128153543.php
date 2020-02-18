<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171128153543 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP VIEW ast_queue_members');
        $this->addSql('CREATE VIEW ast_queue_members AS SELECT QM.id AS uniqueid, CONCAT("b", C.brandId, "c", C.id, "q", Q.id, "_", Q.name) AS queue_name, CONCAT("Local/", QM.id, "@queues") AS interface, CONCAT("b", C.brandId, "c", C.id, "q", Q.id, "m", QM.id) AS membername, CONCAT("PJSIP/", APE.sorcery_id) AS state_interface, QM.penalty, 0 as paused FROM QueueMembers QM JOIN Users U ON U.id=QM.userId JOIN Queues Q ON Q.id=QM.queueId JOIN Terminals T ON T.id=U.terminalId JOIN ast_ps_endpoints APE ON APE.terminalId=T.id JOIN Companies C ON C.id=Q.companyId');    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP VIEW ast_queue_members');
        $this->addSql('CREATE VIEW ast_queue_members AS SELECT QM.id AS uniqueid, CONCAT("b", C.brandId, "c", C.id, "q", Q.id, "_", Q.name) AS queue_name, CONCAT("Local/", QM.id, "@queues") AS interface, CONCAT("b", C.brandId, "c", C.id, "q", Q.id, "m", QM.id) AS membername, CONCAT("PJSIP/", APE.sorcery_id) AS state_interface, QM.penalty FROM QueueMembers QM JOIN Users U ON U.id=QM.userId JOIN Queues Q ON Q.id=QM.queueId JOIN Terminals T ON T.id=U.terminalId JOIN ast_ps_endpoints APE ON APE.terminalId=T.id JOIN Companies C ON C.id=Q.companyId');
    }
}
