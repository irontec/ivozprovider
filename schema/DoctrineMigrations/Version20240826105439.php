<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240826105439 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Altered BillableCalls, UsersCdrs starTime to not-nullable ';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE BillableCalls CHANGE startTime startTime DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL');
        $this->addSql('ALTER TABLE UsersCdrs CHANGE startTime startTime DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE BillableCalls CHANGE startTime startTime DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE UsersCdrs CHANGE startTime startTime DATETIME DEFAULT NULL');
    }
}