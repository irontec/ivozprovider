<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200907104925 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE MaxUsageNotifications (id INT UNSIGNED AUTO_INCREMENT NOT NULL, toAddress VARCHAR(255) DEFAULT NULL, threshold NUMERIC(10, 4) DEFAULT \'0\' COMMENT \'(DC2Type:decimal)\', lastSent DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\', companyId INT UNSIGNED DEFAULT NULL, notificationTemplateId INT UNSIGNED DEFAULT NULL, INDEX IDX_FBA0A3A62480E723 (companyId), INDEX IDX_FBA0A3A61333F77D (notificationTemplateId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE MaxUsageNotifications ADD CONSTRAINT FK_FBA0A3A62480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE MaxUsageNotifications ADD CONSTRAINT FK_FBA0A3A61333F77D FOREIGN KEY (notificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE MaxUsageNotifications');
    }
}
