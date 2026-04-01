<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20260318170403 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add Webhooks table, PublicEntity and Feature';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE Webhooks (
            id INT UNSIGNED AUTO_INCREMENT NOT NULL, 
            name VARCHAR(64) NOT NULL, 
            description VARCHAR(255) DEFAULT NULL, 
            URI LONGTEXT NOT NULL, 
            eventStart TINYINT(1) DEFAULT 0 NOT NULL, 
            eventRing TINYINT(1) DEFAULT 0 NOT NULL, 
            eventAnswer TINYINT(1) DEFAULT 0 NOT NULL, 
            eventEnd TINYINT(1) DEFAULT 0 NOT NULL, 
            template LONGTEXT NOT NULL, 
            brandId INT UNSIGNED NOT NULL, 
            companyId INT UNSIGNED DEFAULT NULL, 
            ddiId INT UNSIGNED DEFAULT NULL, 
            INDEX IDX_60FA2D8B9CBEC244 (brandId), 
            INDEX IDX_60FA2D8B2480E723 (companyId), 
            INDEX IDX_60FA2D8B32B6E766 (ddiId), 
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Webhooks ADD CONSTRAINT FK_60FA2D8B9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Webhooks ADD CONSTRAINT FK_60FA2D8B2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Webhooks ADD CONSTRAINT FK_60FA2D8B32B6E766 FOREIGN KEY (ddiId) REFERENCES DDIs (id) ON DELETE CASCADE');

        $this->addSql("INSERT INTO PublicEntities (
                            iden, fqdn, platform, brand, client,
                            name_en, name_es, name_ca, name_it, name_eu
                        ) VALUES (
                            'Webhooks', 'Ivoz\\\\Provider\\\\Domain\\\\Model\\\\Webhook\\\\Webhook', 0, 1, 1,
                            'Webhooks', 'Webhooks', 'Webhooks', 'Webhooks', 'Webhooks'
                        )"
        );

        $this->addSql(
            'INSERT INTO Features (iden, name_en, name_es, name_ca, name_it, name_eu) VALUES (
                    "webhooks",
                    "Webhooks",
                    "Webhooks",
                    "Webhooks",
                    "Webhooks",
                    "Webhooks"
                )'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM Features WHERE iden = "webhooks"');
        $this->addSql('DELETE FROM PublicEntities WHERE iden = "Webhooks"');
        $this->addSql('DROP TABLE Webhooks');
    }
}