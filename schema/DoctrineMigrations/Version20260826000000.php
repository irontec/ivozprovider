<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20260826000000 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add ChannelUsages table and PublicEntity for channel usage historics per client';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE ChannelUsages (
            id INT UNSIGNED AUTO_INCREMENT NOT NULL,
            brandId INT UNSIGNED NOT NULL,
            companyId INT UNSIGNED NOT NULL,
            timestamp DATETIME NOT NULL,
            peak SMALLINT UNSIGNED NOT NULL,
            avgUsage DECIMAL(6, 2) NOT NULL,
            closingUsage SMALLINT UNSIGNED NOT NULL,
            maxCallsCompany SMALLINT UNSIGNED NOT NULL,
            maxCallsBrand SMALLINT UNSIGNED NOT NULL,
            blockedByCompanyLimit SMALLINT UNSIGNED DEFAULT 0 NOT NULL,
            blockedByBrandLimit SMALLINT UNSIGNED DEFAULT 0 NOT NULL,
            UNIQUE INDEX chUsage_company_ts (companyId, timestamp),
            INDEX channelUsage_brandId_idx (brandId),
            INDEX channelUsage_timestamp_idx (timestamp),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ChannelUsages ADD CONSTRAINT FK_ChannelUsages_brandId
            FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ChannelUsages ADD CONSTRAINT FK_ChannelUsages_companyId
            FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');

        $this->addSql("INSERT INTO PublicEntities (
                            iden, fqdn, platform, brand, client,
                            name_en, name_es, name_ca, name_it, name_eu
                        ) VALUES (
                            'ChannelUsages', 'Ivoz\\\\Provider\\\\Domain\\\\Model\\\\ChannelUsage\\\\ChannelUsage', 0, 0, 1,
                            'Channel usage', 'Uso de canales', 'Uso de canales', 'Channel usage', 'Uso de canales'
                        )"
        );

        // Restricted client admins that already exist do not go through CreateAcls, which
        // only seeds permissions when the restricted flag itself changes. Without a row they
        // would be stuck: the ACL resource exposes no POST, so nobody could ever grant them
        // this entity from the portal.
        //
        // The row is therefore created deny-all, exactly as Version20220408095037 did for
        // Locations/Voicemails/VoicemailMessages: the entity becomes grantable without
        // silently widening anyone's access. Admins made restricted from now on keep getting
        // read access automatically, since CreateAcls seeds every client = 1 entity.
        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 0, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NOT NULL AND A.companyId IS NOT NULL AND P.iden = "ChannelUsages"'
        );
    }

    public function down(Schema $schema): void
    {
        // AdministratorRelPublicEntities.publicEntityId is ON DELETE CASCADE, so dropping the
        // public entity takes its permission rows with it. Do not add an explicit delete here:
        // it would also remove rows created later by CreateAcls.
        $this->addSql('DELETE FROM PublicEntities WHERE iden = "ChannelUsages"');
        $this->addSql('ALTER TABLE ChannelUsages DROP FOREIGN KEY FK_ChannelUsages_brandId');
        $this->addSql('ALTER TABLE ChannelUsages DROP FOREIGN KEY FK_ChannelUsages_companyId');
        $this->addSql('DROP TABLE ChannelUsages');
    }
}
