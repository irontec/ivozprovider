<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301093113 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Default empty values in brand invoicing fields';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'ALTER TABLE Brands 
            CHANGE nif nif VARCHAR(25) DEFAULT \'\' NOT NULL,
            CHANGE postalAddress postalAddress VARCHAR(255) DEFAULT \'\' NOT NULL,
            CHANGE postalCode postalCode VARCHAR(10) DEFAULT \'\' NOT NULL,
            CHANGE town town VARCHAR(255) DEFAULT \'\' NOT NULL,
            CHANGE province province VARCHAR(255) DEFAULT \'\' NOT NULL,
            CHANGE country country VARCHAR(255) DEFAULT \'\' NOT NULL,
            CHANGE registryData registryData VARCHAR(1024) DEFAULT \'\''
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'ALTER TABLE Brands 
            CHANGE nif nif VARCHAR(25) NOT NULL,
            CHANGE postalAddress postalAddress VARCHAR(255) NOT NULL,
            CHANGE postalCode postalCode VARCHAR(10) NOT NULL,
            CHANGE town town VARCHAR(255) NOT NULL,
            CHANGE province province VARCHAR(255) NOT NULL,
            CHANGE country country VARCHAR(255) NOT NULL,
            CHANGE registryData registryData VARCHAR(1024) DEFAULT NULL'
        );
    }
}
