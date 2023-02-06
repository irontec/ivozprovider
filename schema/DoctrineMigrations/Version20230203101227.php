<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203101227 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Remove DDIs.billInboundCalls';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE DDIs DROP billInboundCalls');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE DDIs ADD billInboundCalls TINYINT(1) DEFAULT 0 NOT NULL');
    }
}
