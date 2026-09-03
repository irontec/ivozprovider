<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20260903000000 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Rename NotificationTemplatesContents public entity iden to NotificationTemplateContents';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE PublicEntities SET iden = "NotificationTemplateContents" WHERE iden = "NotificationTemplatesContents"');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE PublicEntities SET iden = "NotificationTemplatesContents" WHERE iden = "NotificationTemplateContents"');
    }
}
