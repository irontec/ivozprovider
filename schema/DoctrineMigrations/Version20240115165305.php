<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115165305 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Fixed UsersCdrs disposition typo';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE UsersCdrs CHANGE disposition disposition VARCHAR(8) DEFAULT \'answered\' COMMENT \'[enum:answered|missed|busy]\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE UsersCdrs CHANGE disposition disposition VARCHAR(8) DEFAULT \'answered\' COMMENT \'[enum:answered|missed|bussy]\'');
    }
}
