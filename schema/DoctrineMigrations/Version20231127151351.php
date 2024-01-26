<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127151351 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add parsed column on kam_users_cdrs';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kam_users_cdrs ADD parsed TINYINT(1) DEFAULT 0');
        $this->addSql('CREATE INDEX userCdr_parsed ON kam_users_cdrs (parsed)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX userCdr_parsed ON kam_users_cdrs');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP parsed');
    }
}
