<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240515135813 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added FaxesRelUsers table';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE FaxesRelUsers (id INT UNSIGNED AUTO_INCREMENT NOT NULL, userId INT UNSIGNED NOT NULL, faxId INT UNSIGNED NOT NULL, INDEX IDX_B9318E2964B64DCC (userId), INDEX IDX_B9318E29624C8D73 (faxId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE FaxesRelUsers ADD CONSTRAINT FK_B9318E2964B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE FaxesRelUsers ADD CONSTRAINT FK_B9318E29624C8D73 FOREIGN KEY (faxId) REFERENCES Faxes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE FaxesRelUsers');
    }
}