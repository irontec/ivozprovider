<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190117144921 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers ADD callCsvNotificationTemplateId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E74EE731B FOREIGN KEY (callCsvNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_100E171E74EE731B ON CallCsvSchedulers (callCsvNotificationTemplateId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CallCsvSchedulers DROP FOREIGN KEY FK_100E171E74EE731B');
        $this->addSql('DROP INDEX IDX_100E171E74EE731B ON CallCsvSchedulers');
        $this->addSql('ALTER TABLE CallCsvSchedulers DROP callCsvNotificationTemplateId');
    }
}
