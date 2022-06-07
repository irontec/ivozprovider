<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220606152356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migrate from HuntGroupsRelUsers to HuntGroupMembers';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('RENAME TABLE HuntGroupsRelUsers TO HuntGroupMembers');
        $this->addSql('ALTER TABLE HuntGroupMembers RENAME INDEX idx_79ed31ab921b2343 TO IDX_7A4A43DB921B2343');
        $this->addSql('ALTER TABLE HuntGroupMembers RENAME INDEX idx_79ed31abd7819488 TO IDX_7A4A43DBD7819488');

        // Add Administrator ACLs for HuntGroupMember entity
        $this->addSql("INSERT IGNORE INTO PublicEntities (
                            iden, fqdn, platform, brand, client,
                            name_en, name_es, name_ca, name_it
                        ) VALUES (
                            'HuntGroupMembers', 'Ivoz\\\\Provider\\\\Domain\\\\Model\\\\HuntGroupMember\\\\HuntGroupMember', 0, 0, 1,
                            'Hunt Group Members', 'Miembros Grupo de salto', 'Miembros Grupo de salto', 'Hunt Group Members'
                        )");
        $this->addSql("DELETE FROM PublicEntities WHERE iden = 'HuntGroupsRelUsers'");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('RENAME TABLE HuntGroupMembers TO HuntGroupsRelUsers');
    }
}
