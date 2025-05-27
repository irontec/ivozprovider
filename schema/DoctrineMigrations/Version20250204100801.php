<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250204100801 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Update ast_ps_endpoints and ast_ps_aors to support MWI subscriptions';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ast_ps_endpoints ADD mwi_subscribe_replaces_unsolicited VARCHAR(5) DEFAULT \'yes\' NOT NULL COMMENT \'[enum:yes|no]\'');

        // Regenerate ast_ps_aors view with new mailboxes field
        $this->addSql("DROP VIEW ast_ps_aors");
        $this->addSql('CREATE VIEW ast_ps_aors AS
            SELECT
                CONCAT("b", C.brandId, "c", C.id, E.type, E.id, "_", E.name) AS sorcery_id,
                CONCAT("sip:", E.name, "@", D.domain) AS contact,
                0 as qualify_frequency,
                (SELECT mailboxes FROM ast_ps_endpoints WHERE sorcery_id = CONCAT("b", C.brandId, "c", C.id, E.type, E.id, "_", E.name) LIMIT 1) AS mailboxes
            FROM (
                SELECT "t" AS type, id, name, domainId, companyId FROM Terminals
            UNION
                SELECT "f" AS type, id, name, domainId, companyId FROM Friends
            UNION
                SELECT "r" AS type, id, name, domainId, companyId FROM ResidentialDevices
            UNION
                SELECT "rt" AS type, id, name, domainId, companyId FROM RetailAccounts
            ) AS E
                INNER JOIN Companies C ON C.id = E.companyId
                INNER JOIN Domains D ON D.id = E.domainId'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP mwi_subscribe_replaces_unsolicited');
    }
}
