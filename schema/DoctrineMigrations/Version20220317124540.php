<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220317124540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add hints fields to ast_ps_endpoints';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ast_ps_endpoints
          ADD subscribe_context VARCHAR(40) DEFAULT NULL AFTER named_pickup_group,
          ADD hint_extension VARCHAR(10) DEFAULT NULL AFTER subscribe_context');

        // Update new fields with Users data
        $this->addSql('UPDATE ast_ps_endpoints APE
            INNER JOIN Terminals T ON T.id = APE.terminalId
            INNER JOIN Users U ON U.terminalId = T.id
            INNER JOIN Extensions E ON E.id = U.extensionId
            SET APE.hint_extension = E.number,
            APE.subscribe_context = CONCAT("company", T.companyID)
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP subscribe_context, DROP hint_extension');
    }
}
