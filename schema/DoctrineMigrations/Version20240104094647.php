<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104094647 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added accessCredentials relation into Company.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Companies ADD accessCredentialNotificationTemplateId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B5289993CA25D7 FOREIGN KEY (accessCredentialNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B5289993CA25D7 ON Companies (accessCredentialNotificationTemplateId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B5289993CA25D7');
        $this->addSql('DROP INDEX IDX_B5289993CA25D7 ON Companies');
        $this->addSql('ALTER TABLE Companies DROP accessCredentialNotificationTemplateId');
    }
}
