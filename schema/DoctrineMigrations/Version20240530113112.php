<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20240530113112 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Remove klear specific fields';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE WebPortals DROP klearTheme, DROP newUI');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE WebPortals ADD klearTheme VARCHAR(200) DEFAULT \'\', ADD newUI TINYINT(1) DEFAULT 1 NOT NULL');
    }
}