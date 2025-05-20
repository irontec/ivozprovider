<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20250514135139 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add errorCount into InvoiceSchedulers';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE InvoiceSchedulers ADD errorCount SMALLINT UNSIGNED DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE InvoiceSchedulers DROP errorCount');
    }
}
