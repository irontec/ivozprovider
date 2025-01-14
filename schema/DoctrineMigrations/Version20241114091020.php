<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20241114091020 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added default empty string to email in CallCsvSchedulers';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE CallCsvSchedulers CHANGE email email VARCHAR(140) DEFAULT \'\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE CallCsvSchedulers CHANGE email email VARCHAR(140) NOT NULL');
    }
}