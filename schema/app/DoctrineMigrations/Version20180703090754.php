<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180703090754 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /** Create new DDIProvider tables **/
        $this->addSql('CREATE TABLE DDIProviders (
                            id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                            name VARCHAR(200) NOT NULL,
                            description VARCHAR(500) DEFAULT \'\' NOT NULL,
                            externallyRated TINYINT(1) UNSIGNED DEFAULT \'0\',
                            brandId INT UNSIGNED NOT NULL,
                            transformationRuleSetId INT UNSIGNED DEFAULT NULL,
                        INDEX IDX_CA534EFD9CBEC244 (brandId),
                        INDEX IDX_CA534EFD2FECF701 (transformationRuleSetId),
                        UNIQUE INDEX ddiProvider_nameBrand (name, brandId),
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8
                        COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql('CREATE TABLE DDIProviderAddresses (
                            id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                            ip VARCHAR(50) DEFAULT NULL,
                            description VARCHAR(200) DEFAULT NULL,
                            ddiProviderId INT UNSIGNED NOT NULL,
                            INDEX IDX_FEDB46FE53615680 (ddiProviderId),
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8
                        COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql('CREATE TABLE DDIProviderRegistrations (
                            id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                            username VARCHAR(64) DEFAULT \'\' NOT NULL,
                            domain VARCHAR(190) DEFAULT \'\' NOT NULL,
                            realm VARCHAR(64) DEFAULT \'\' NOT NULL,
                            authUsername VARCHAR(64) DEFAULT \'\' NOT NULL,
                            authPassword VARCHAR(64) DEFAULT \'\' NOT NULL,
                            authProxy VARCHAR(64) DEFAULT \'\' NOT NULL,
                            expires INT DEFAULT 0 NOT NULL,
                            multiDdi TINYINT(1) UNSIGNED DEFAULT \'0\',
                            contactUsername VARCHAR(64) DEFAULT \'\' NOT NULL,
                            ddiProviderId INT UNSIGNED NOT NULL,
                        INDEX IDX_B2E9E33B53615680 (ddiProviderId),
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8
                        COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql('ALTER TABLE DDIProviders ADD CONSTRAINT FK_CA534EFD9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE DDIProviders ADD CONSTRAINT FK_CA534EFD2FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE DDIProviderAddresses ADD CONSTRAINT FK_FEDB46FE53615680 FOREIGN KEY (ddiProviderId) REFERENCES DDIProviders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE DDIProviderRegistrations ADD CONSTRAINT FK_BBD03C6953615680 FOREIGN KEY (ddiProviderId) REFERENCES DDIProviders (id) ON DELETE CASCADE');

        /** Migrate data to DDIProviders and DDIProviderRegistrations **/
        $this->addSql('INSERT INTO DDIProviders (id, name, description, externallyRated, brandId, transformationRuleSetId) SELECT id, name, description, externallyRated, brandId, transformationRuleSetId FROM PeeringContracts');
        $this->addSql('INSERT INTO DDIProviderRegistrations (id, username, domain, realm, authUsername, authPassword, authProxy, expires, multiDDi, contactUsername, ddiProviderId) SELECT id, r_username, r_domain, realm, auth_username, auth_password, auth_proxy, expires, multiDDI, l_uuid, peeringContractId FROM kam_trunks_uacreg');
        $this->addSql('INSERT INTO DDIProviderAddresses (id, ip, ddiProviderId) SELECT id, COALESCE(ip, sip_proxy), peeringContractId FROM PeerServers');

        /** Update kam_trunks_uacreg Table **/
        $this->addSql('ALTER TABLE kam_trunks_uacreg DROP FOREIGN KEY kam_trunks_uacreg_ibfk_2');
        $this->addSql('DROP INDEX trunksUacreg_peeringContractId ON kam_trunks_uacreg');
        $this->addSql('ALTER TABLE kam_trunks_uacreg CHANGE peeringcontractid ddiProviderRegistrationId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE kam_trunks_uacreg DROP multiDDI');
        $this->addSql('UPDATE kam_trunks_uacreg SET ddiProviderRegistrationId = id');
        $this->addSql('ALTER TABLE kam_trunks_uacreg ADD CONSTRAINT FK_C6127821B6A472B7 FOREIGN KEY (ddiProviderRegistrationId) REFERENCES DDIProviderRegistrations (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C612782140D0284C ON kam_trunks_uacreg (ddiProviderRegistrationId)');
        $this->addSql('ALTER TABLE kam_trunks_uacreg RENAME INDEX trunksuacreg_brandid TO IDX_C61278219CBEC244');

        /** Update DDIs Table **/
        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY DDIs_ibfk_8');
        $this->addSql('DROP INDEX IDX_AA16E1A07DB780F8 ON DDIs');
        $this->addSql('ALTER TABLE DDIs CHANGE peeringcontractid ddiProviderId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT FK_AA16E1A053615680 FOREIGN KEY (ddiProviderId) REFERENCES DDIProviders (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AA16E1A053615680 ON DDIs (ddiProviderId)');

        /** Update PeeringContracts Table **/
        $this->addSql('ALTER TABLE PeeringContracts RENAME INDEX name_per_brand TO peeringContract_nameBrand');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE DDIs DROP FOREIGN KEY FK_AA16E1A053615680');
        $this->addSql('DROP INDEX IDX_AA16E1A053615680 ON DDIs');
        $this->addSql('ALTER TABLE DDIs CHANGE ddiproviderid peeringContractId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE DDIs ADD CONSTRAINT DDIs_ibfk_8 FOREIGN KEY (peeringContractId) REFERENCES PeeringContracts (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AA16E1A07DB780F8 ON DDIs (peeringContractId)');

        $this->addSql('ALTER TABLE kam_trunks_uacreg DROP FOREIGN KEY FK_C6127821B6A472B7');
        $this->addSql('DROP INDEX UNIQ_C612782140D0284C ON kam_trunks_uacreg');
        $this->addSql('ALTER TABLE kam_trunks_uacreg CHANGE ddiproviderregistrationid peeringContractId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE kam_trunks_uacreg ADD multiDDI TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('UPDATE kam_trunks_uacreg KTU INNER JOIN DDIProviderRegistrations DPR ON DPR.id = KTU.id SET KTU.peeringContractId = DPR.ddiProviderId, KTU.multiDDI = DPR.multiDdi');
        $this->addSql('ALTER TABLE kam_trunks_uacreg ADD CONSTRAINT kam_trunks_uacreg_ibfk_2 FOREIGN KEY (peeringContractId) REFERENCES PeeringContracts (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX trunksUacreg_peeringContractId ON kam_trunks_uacreg (peeringContractId)');
        $this->addSql('ALTER TABLE kam_trunks_uacreg RENAME INDEX idx_c61278219cbec244 TO trunksUacreg_brandId');

        $this->addSql('ALTER TABLE PeeringContracts RENAME INDEX peeringContract_nameBrand TO name_per_brand');

        $this->addSql('ALTER TABLE DDIProviderAddresses DROP FOREIGN KEY FK_FEDB46FE53615680');
        $this->addSql('ALTER TABLE DDIProviderRegistrations DROP FOREIGN KEY FK_BBD03C6953615680');
        $this->addSql('DROP TABLE DDIProviders');
        $this->addSql('DROP TABLE DDIProviderAddresses');
        $this->addSql('DROP TABLE DDIProviderRegistrations');
    }
}
