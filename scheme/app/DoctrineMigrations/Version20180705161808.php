<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180705161808 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways DROP FOREIGN KEY kam_trunks_lcr_gateways_ibfk_2');
        $this->addSql('ALTER TABLE OutgoingRouting DROP FOREIGN KEY OutgoingRouting_ibfk_5');
        $this->addSql('ALTER TABLE PeerServers DROP FOREIGN KEY PeerServers_ibfk_1');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB67DB780F8');
        $this->addSql('CREATE TABLE CarrierServers (
                              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                              ip VARCHAR(50) DEFAULT NULL,
                              hostname VARCHAR(64) DEFAULT NULL,
                              port SMALLINT UNSIGNED DEFAULT NULL,
                              uriScheme SMALLINT UNSIGNED DEFAULT NULL,
                              transport SMALLINT UNSIGNED DEFAULT NULL,
                              sendPAI TINYINT(1) UNSIGNED DEFAULT \'0\',
                              sendRPID TINYINT(1) UNSIGNED DEFAULT \'0\',
                              authNeeded VARCHAR(255) DEFAULT \'no\' NOT NULL,
                              authUser VARCHAR(64) DEFAULT NULL,
                              authPassword VARCHAR(64) DEFAULT NULL,
                              sipProxy VARCHAR(128) DEFAULT NULL,
                              outboundProxy VARCHAR(128) DEFAULT NULL,
                              fromUser VARCHAR(64) DEFAULT NULL,
                              fromDomain VARCHAR(190) DEFAULT NULL,
                              carrierId INT UNSIGNED NOT NULL,
                              brandId INT UNSIGNED NOT NULL,
                          INDEX IDX_991132C66709B1C (carrierId),
                          INDEX IDX_991132C69CBEC244 (brandId),
                          PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8
                          COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql('CREATE TABLE Carriers (
                              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                              brandId INT UNSIGNED NOT NULL,
                              description VARCHAR(500) DEFAULT \'\' NOT NULL,
                              name VARCHAR(200) NOT NULL,
                              externallyRated TINYINT(1) UNSIGNED DEFAULT \'0\',
                              transformationRuleSetId INT UNSIGNED DEFAULT NULL,
                          INDEX IDX_F63EC8E39CBEC244 (brandId),
                          INDEX IDX_F63EC8E32FECF701 (transformationRuleSetId),
                          UNIQUE INDEX carrier_nameBrand (name, brandId),
                          PRIMARY KEY(id))DEFAULT CHARACTER SET utf8
                          COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE CarrierServers ADD CONSTRAINT FK_991132C66709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CarrierServers ADD CONSTRAINT FK_991132C69CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Carriers ADD CONSTRAINT FK_F63EC8E39CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Carriers ADD CONSTRAINT FK_F63EC8E32FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');

        $this->addSql('INSERT INTO Carriers SELECT * FROM PeeringContracts');
        $this->addSql('INSERT INTO CarrierServers (
                                  id, ip, hostname, port, uriScheme, transport, sendPAI, sendRPID,
                                  authUser, authNeeded, authPassword, sipProxy, outboundProxy,
                                  fromUser, fromDomain, carrierId, brandId
                            ) SELECT
                                  id, ip, hostname, port, uri_scheme, transport, sendPAI, sendRPID,
                                  auth_user, auth_needed, auth_password, sip_proxy, outbound_proxy,
                                  from_user, from_domain, peeringContractId, brandId
                            FROM PeerServers');

        $this->addSql('DROP TABLE PeerServers');
        $this->addSql('DROP TABLE PeeringContracts');
        $this->addSql('DROP INDEX IDX_569314727DB780F8 ON OutgoingRouting');
        $this->addSql('ALTER TABLE OutgoingRouting CHANGE peeringcontractid carrierId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE OutgoingRouting ADD CONSTRAINT FK_569314726709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_569314726709B1C ON OutgoingRouting (carrierId)');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('DROP INDEX IDX_92E58EB67DB780F8 ON kam_trunks_cdrs');
        $this->addSql('ALTER TABLE kam_trunks_cdrs CHANGE peeringcontractid carrierId INT UNSIGNED DEFAULT NULL');
        $this->addSql('UPDATE kam_trunks_cdrs SET carrierId = NULL WHERE carrierId NOT IN (SELECT id FROM Carriers)');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB66709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_92E58EB66709B1C ON kam_trunks_cdrs (carrierId)');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');
        $this->addSql('DROP INDEX peerServerIdUnique ON kam_trunks_lcr_gateways');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways CHANGE peerserverid carrierServerId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways ADD CONSTRAINT FK_C13516F0472FDC9C FOREIGN KEY (carrierServerId) REFERENCES CarrierServers (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C13516F0472FDC9C ON kam_trunks_lcr_gateways (carrierServerId)');

        $this->addSql('UPDATE kam_trunks_lcr_gateways KTLG
                                INNER JOIN CarrierServers CS ON CS.id = KTLG.carrierServerId
                                INNER JOIN Carriers C ON C.id = CS.carrierId
                            SET gw_name = CONCAT("b", C.brandId, "c", C.id, "s", CS.id)'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways DROP FOREIGN KEY FK_C13516F0472FDC9C');
        $this->addSql('ALTER TABLE CarrierServers DROP FOREIGN KEY FK_991132C66709B1C');
        $this->addSql('ALTER TABLE OutgoingRouting DROP FOREIGN KEY FK_569314726709B1C');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB66709B1C');
        $this->addSql('CREATE TABLE PeerServers (id INT UNSIGNED AUTO_INCREMENT NOT NULL, peeringContractId INT UNSIGNED NOT NULL, ip VARCHAR(50) DEFAULT NULL COLLATE utf8_general_ci, brandId INT UNSIGNED NOT NULL, hostname VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, port SMALLINT UNSIGNED DEFAULT NULL, uri_scheme SMALLINT UNSIGNED DEFAULT NULL, transport SMALLINT UNSIGNED DEFAULT NULL, sendPAI TINYINT(1) DEFAULT \'0\', sendRPID TINYINT(1) DEFAULT \'0\', auth_needed VARCHAR(255) DEFAULT \'no\' NOT NULL COLLATE utf8_general_ci, auth_user VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, auth_password VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, sip_proxy VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, outbound_proxy VARCHAR(128) DEFAULT NULL COLLATE utf8_general_ci, from_user VARCHAR(64) DEFAULT NULL COLLATE utf8_general_ci, from_domain VARCHAR(190) DEFAULT NULL COLLATE utf8_general_ci, INDEX IDX_C12DE2EF7DB780F8 (peeringContractId), INDEX IDX_C12DE2EF9CBEC244 (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PeeringContracts (id INT UNSIGNED AUTO_INCREMENT NOT NULL, brandId INT UNSIGNED NOT NULL, description VARCHAR(500) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, name VARCHAR(200) NOT NULL COLLATE utf8_general_ci, externallyRated TINYINT(1) DEFAULT \'0\', transformationRuleSetId INT UNSIGNED DEFAULT NULL, UNIQUE INDEX peeringContract_nameBrand (name, brandId), INDEX IDX_6E479B029CBEC244 (brandId), INDEX IDX_6E479B022FECF701 (transformationRuleSetId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE PeerServers ADD CONSTRAINT PeerServers_ibfk_1 FOREIGN KEY (peeringContractId) REFERENCES PeeringContracts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PeerServers ADD CONSTRAINT PeerServers_ibfk_2 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PeeringContracts ADD CONSTRAINT FK_6E479B022FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE PeeringContracts ADD CONSTRAINT PeeringContracts_ibfk_1 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');

        $this->addSql('INSERT INTO PeeringContracts SELECT * FROM Carriers');
        $this->addSql('INSERT INTO PeerServers (
                                  id, ip, hostname, port, uri_scheme, transport, sendPAI, sendRPID,
                                  auth_user, auth_needed, auth_password, sip_proxy, outbound_proxy,
                                  from_user, from_domain, peeringContractId, brandId
                            ) SELECT
                                  id, ip, hostname, port, uriScheme, transport, sendPAI, sendRPID,
                                  authUser, authNeeded, authPassword, sipProxy, outboundProxy,
                                  fromUser, fromDomain, carrierId, brandId
                            FROM CarrierServers');

        $this->addSql('DROP TABLE CarrierServers');
        $this->addSql('DROP TABLE Carriers');
        $this->addSql('DROP INDEX IDX_569314726709B1C ON OutgoingRouting');
        $this->addSql('ALTER TABLE OutgoingRouting CHANGE carrierid peeringContractId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE OutgoingRouting ADD CONSTRAINT OutgoingRouting_ibfk_5 FOREIGN KEY (peeringContractId) REFERENCES PeeringContracts (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_569314727DB780F8 ON OutgoingRouting (peeringContractId)');
        $this->addSql('DROP INDEX IDX_92E58EB66709B1C ON kam_trunks_cdrs');
        $this->addSql('ALTER TABLE kam_trunks_cdrs CHANGE carrierid peeringContractId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB67DB780F8 FOREIGN KEY (peeringContractId) REFERENCES PeeringContracts (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_92E58EB67DB780F8 ON kam_trunks_cdrs (peeringContractId)');
        $this->addSql('DROP INDEX UNIQ_C13516F0472FDC9C ON kam_trunks_lcr_gateways');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways CHANGE carrierserverid peerServerId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE kam_trunks_lcr_gateways ADD CONSTRAINT kam_trunks_lcr_gateways_ibfk_2 FOREIGN KEY (peerServerId) REFERENCES PeerServers (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX peerServerIdUnique ON kam_trunks_lcr_gateways (peerServerId)');
    }
}
