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
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM PublicEntities WHERE iden = "ChannelUsages"');
        $this->addSql('ALTER TABLE ChannelUsages DROP FOREIGN KEY FK_ChannelUsages_brandId');
        $this->addSql('ALTER TABLE ChannelUsages DROP FOREIGN KEY FK_ChannelUsages_companyId');
        $this->addSql('DROP TABLE ChannelUsages');
    }
}
