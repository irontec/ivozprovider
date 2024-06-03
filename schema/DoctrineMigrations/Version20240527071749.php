<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240527071749 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add @extension field to ast_ps_endpoints table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ast_ps_endpoints ADD `@extension` VARCHAR(25) DEFAULT NULL');

        // Update field for existing endpoints
        $this->addSql('UPDATE ast_ps_endpoints APE INNER JOIN Terminals T ON T.id = APE.terminalId INNER JOIN Users U ON U.terminalId = T.id INNER JOIN Extensions E ON E.id = U.extensionId SET `@extension` = E.number');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP `@extension`');
    }
}
