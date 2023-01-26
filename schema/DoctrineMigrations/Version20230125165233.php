<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125165233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add rtp_timeout and rtp_timeout_hold fields to ast_ps_endpoints table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ast_ps_endpoints ADD rtp_timeout INT DEFAULT 60 NOT NULL, ADD rtp_timeout_hold INT DEFAULT 600 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP rtp_timeout, DROP rtp_timeout_hold');
    }
}
