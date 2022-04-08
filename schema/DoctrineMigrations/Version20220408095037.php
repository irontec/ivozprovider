<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408095037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert missing values in AdministratorRelPublicEntities for Locations, Voicemails and VoicemailMessages';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'INSERT IGNORE INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 0, 0, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.restricted = 1 AND A.brandId IS NOT NULL AND A.companyId IS NOT NULL AND P.iden in ("Locations", "Voicemails", "VoicemailMessages")'
        );
    }

    public function down(Schema $schema): void
    {
    }
}
