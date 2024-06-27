<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20240627075829 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added company reference to WebPortals';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE WebPortals ADD companyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE WebPortals ADD CONSTRAINT FK_C811E30C2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C811E30C2480E723 ON WebPortals (companyId)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE WebPortals DROP FOREIGN KEY FK_C811E30C2480E723');
        $this->addSql('DROP INDEX IDX_C811E30C2480E723 ON WebPortals');
        $this->addSql('ALTER TABLE WebPortals DROP companyId');
    }
}
