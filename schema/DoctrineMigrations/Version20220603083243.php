<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220603083243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make BillableCalls direction not nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE BillableCalls CHANGE direction direction VARCHAR(255) DEFAULT \'outbound\' NOT NULL COMMENT \'[enum:inbound|outbound]\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE BillableCalls CHANGE direction direction VARCHAR(255) DEFAULT \'outbound\' COMMENT \'[enum:inbound|outbound]\'');
    }
}
