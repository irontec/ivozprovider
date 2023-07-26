<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511143859 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added constraint ensuring unique company, interCompany relation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX companyInterCompany ON Friends (companyId, interCompanyId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX companyInterCompany ON Friends');
    }
}
