<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929101012 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Change kam_users_location_attrs id to bigint';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kam_users_location_attrs CHANGE id id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kam_users_location_attrs CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL');
    }
}
