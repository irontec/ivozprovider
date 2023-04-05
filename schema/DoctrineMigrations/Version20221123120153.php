<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20221123120153 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add position announce fields to queues tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Queues ADD announcePosition VARCHAR(10) DEFAULT \'no\' COMMENT \'[enum:yes|no]\', ADD announceFrequency INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ast_queues ADD announce_position VARCHAR(128) DEFAULT \'no\', ADD announce_frequency INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Queues DROP announcePosition, DROP announceFrequency');
        $this->addSql('ALTER TABLE ast_queues DROP announce_position, DROP announce_frequency');
    }
}
