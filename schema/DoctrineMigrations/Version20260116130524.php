<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20260116130524 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Sanitize invoice PDF file names by replacing slashes with dashes';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("UPDATE Invoices SET pdfFileBaseName = REPLACE(pdfFileBaseName, '/', '-') WHERE pdfFileBaseName LIKE '%/%'");
    }

    public function down(Schema $schema): void
    {
        // This migration cannot be reverted as we cannot reliably restore original slashes
    }
}
