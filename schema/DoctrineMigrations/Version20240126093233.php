<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240126093233 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added error enum value into UsersCdrs.disposition';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE UsersCdrs CHANGE disposition disposition VARCHAR(8) DEFAULT \'answered\' COMMENT \'[enum:answered|missed|busy|error]\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE UsersCdrs CHANGE disposition disposition VARCHAR(8) DEFAULT \'answered\' COMMENT \'[enum:answered|missed|busy]\'');
    }
}
