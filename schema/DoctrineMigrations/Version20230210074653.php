<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210074653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Set company invoice fields default value';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'ALTER TABLE Companies
            CHANGE nif nif VARCHAR(25) NOT NULL DEFAULT \'\',
            CHANGE postalAddress postalAddress VARCHAR(255) NOT NULL DEFAULT \'\',
            CHANGE postalCode postalCode VARCHAR(10) NOT NULL DEFAULT \'\',
            CHANGE town town VARCHAR(255) NOT NULL DEFAULT \'\',
            CHANGE province province VARCHAR(255) NOT NULL DEFAULT \'\',
            CHANGE country country VARCHAR(255) NOT NULL DEFAULT \'\'
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(
        'ALTER TABLE Companies CHANGE nif nif VARCHAR(25) NOT NULL,
            CHANGE postalAddress postalAddress VARCHAR(255) NOT NULL,
            CHANGE postalCode postalCode VARCHAR(10) NOT NULL,
            CHANGE town town VARCHAR(255) NOT NULL,
            CHANGE province province VARCHAR(255) NOT NULL,
            CHANGE country country VARCHAR(255) NOT NULL
        ');
    }
}
