<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191017111612 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands ADD vmNotificationTemplateId INT UNSIGNED DEFAULT NULL, ADD faxNotificationTemplateId INT UNSIGNED DEFAULT NULL, ADD invoiceNotificationTemplateId INT UNSIGNED DEFAULT NULL, ADD callCsvNotificationTemplateId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E41021BA12A15 FOREIGN KEY (vmNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E4102E559D278 FOREIGN KEY (faxNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E4102A29D8295 FOREIGN KEY (invoiceNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E410274EE731B FOREIGN KEY (callCsvNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_790E41021BA12A15 ON Brands (vmNotificationTemplateId)');
        $this->addSql('CREATE INDEX IDX_790E4102E559D278 ON Brands (faxNotificationTemplateId)');
        $this->addSql('CREATE INDEX IDX_790E4102A29D8295 ON Brands (invoiceNotificationTemplateId)');
        $this->addSql('CREATE INDEX IDX_790E410274EE731B ON Brands (callCsvNotificationTemplateId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E41021BA12A15');
        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E4102E559D278');
        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E4102A29D8295');
        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E410274EE731B');
        $this->addSql('DROP INDEX IDX_790E41021BA12A15 ON Brands');
        $this->addSql('DROP INDEX IDX_790E4102E559D278 ON Brands');
        $this->addSql('DROP INDEX IDX_790E4102A29D8295 ON Brands');
        $this->addSql('DROP INDEX IDX_790E410274EE731B ON Brands');
        $this->addSql('ALTER TABLE Brands DROP vmNotificationTemplateId, DROP faxNotificationTemplateId, DROP invoiceNotificationTemplateId, DROP callCsvNotificationTemplateId');
    }
}
