<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181121165124 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Companies ADD callCsvNotificationTemplateId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B5289974EE731B FOREIGN KEY (callCsvNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B5289974EE731B ON Companies (callCsvNotificationTemplateId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B5289974EE731B');
        $this->addSql('DROP INDEX IDX_B5289974EE731B ON Companies');
        $this->addSql('ALTER TABLE Companies DROP callCsvNotificationTemplateId');
        $this->addSql('ALTER TABLE InvoiceSchedulers ADD lastExecutionError VARCHAR(300) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
