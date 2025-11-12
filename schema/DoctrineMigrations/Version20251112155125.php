<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20251112155125 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Update FixedCosts description field length to 1024 characters';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE FixedCosts CHANGE description description VARCHAR(1024) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE FixedCosts CHANGE description description VARCHAR(255) DEFAULT NULL');
    }
}