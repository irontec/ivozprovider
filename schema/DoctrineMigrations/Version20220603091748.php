<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220603091748 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Make Country names not nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Countries
                            CHANGE name_en name_en VARCHAR(100) NOT NULL,
                            CHANGE name_es name_es VARCHAR(100) NOT NULL,
                            CHANGE name_ca name_ca VARCHAR(100) NOT NULL,
                            CHANGE name_it name_it VARCHAR(100) NOT NULL'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Countries
                            CHANGE name_en name_en VARCHAR(100) DEFAULT NULL,
                            CHANGE name_es name_es VARCHAR(100) DEFAULT NULL,
                            CHANGE name_ca name_ca VARCHAR(100) DEFAULT NULL,
                            CHANGE name_it name_it VARCHAR(100) DEFAULT NULL'
        );
    }
}
