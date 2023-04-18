<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417110223 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Create and populate ast_queue_members table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP VIEW ast_queue_members');
        $this->addSql('CREATE TABLE ast_queue_members (
                            id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                            uniqueid VARCHAR(80) NOT NULL,
                            queue_name VARCHAR(128) NOT NULL,
                            interface VARCHAR(80) NOT NULL,
                            membername VARCHAR(256) NOT NULL,
                            state_interface VARCHAR(80) NOT NULL,
                            penalty INT NOT NULL,
                            paused INT DEFAULT 0 NOT NULL,
                            queueMemberId INT UNSIGNED DEFAULT NULL,
                        INDEX queueMember_queueMemberId (queueMemberId),
                        PRIMARY KEY(id))
                        DEFAULT CHARACTER SET utf8mb4
                        COLLATE `utf8mb4_unicode_ci`
                        ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE ast_queue_members 
                            ADD CONSTRAINT FK_9EEBA5FCFF8FC3FF
                                FOREIGN KEY (queueMemberId)
                                REFERENCES QueueMembers (id)
                                ON DELETE CASCADE'
        );

        $this->addSql('INSERT INTO ast_queue_members (
                            uniqueid,
                            queue_name,
                            interface,
                            membername,
                            state_interface,
                            penalty,
                            queueMemberId
                        ) SELECT
                            CONCAT("b", C.brandId, "c", C.id, "q", Q.id, "m", QM.id, "_", UNIX_TIMESTAMP()),
                            AQ.name,
                            CONCAT("Local/", E.number, "@queues"),
                            CONCAT(U.name, " ", U.lastname),
                            CONCAT("PJSIP/", APE.sorcery_id),
                            QM.penalty,
                            QM.id
                        FROM QueueMembers QM
                        INNER JOIN Users U ON U.id = QM.userId
                        INNER JOIN Extensions E ON E.id = U.extensionId
                        INNER JOIN Terminals T ON T.id = U.terminalId
                        INNER JOIN Queues Q ON Q.id = QM.queueId
                        INNER JOIN Companies C ON C.id = U.companyId
                        INNER JOIN ast_ps_endpoints APE ON APE.terminalId = T.id
                        INNER JOIN ast_queues AQ on AQ.queueId = Q.id'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ast_queue_members');
        $this->addSql("CREATE VIEW `ast_queue_members` AS select `QM`.`id` AS `uniqueid`,concat('b',`C`.`brandId`,'c',`C`.`id`,'q',`Q`.`id`,'_',`Q`.`name`) AS `queue_name`,concat('Local/',`QM`.`id`,'@queues') AS `interface`,concat('b',`C`.`brandId`,'c',`C`.`id`,'q',`Q`.`id`,'m',`QM`.`id`) AS `membername`,concat('PJSIP/',`APE`.`sorcery_id`) AS `state_interface`,`QM`.`penalty` AS `penalty`,0 AS `paused` from (((((`QueueMembers` `QM` join `Users` `U` on((`U`.`id` = `QM`.`userId`))) join
 `Queues` `Q` on((`Q`.`id` = `QM`.`queueId`))) join `Terminals` `T` on((`T`.`id` = `U`.`terminalId`))) join `ast_ps_endpoints` `APE` on((`APE`.`terminalId` = `T`.`id`))) join `Companies` `C` on((`C`.`id` = `Q`.`companyId`)))");
    }
}
