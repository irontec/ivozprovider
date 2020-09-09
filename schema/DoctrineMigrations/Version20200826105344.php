<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200826105344 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands ADD maxDailyUsageNotificationTemplateId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E4102E81EFEBD FOREIGN KEY (maxDailyUsageNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_790E4102E81EFEBD ON Brands (maxDailyUsageNotificationTemplateId)');

        $this->addSql('ALTER TABLE Companies ADD currentDayUsage NUMERIC(10, 4) DEFAULT \'0\' COMMENT \'(DC2Type:decimal)\', ADD maxDailyUsageEmail VARCHAR(100) DEFAULT NULL, ADD maxDailyUsageNotificationTemplateId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B52899E81EFEBD FOREIGN KEY (maxDailyUsageNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B52899E81EFEBD ON Companies (maxDailyUsageNotificationTemplateId)');

        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COMMENT \'[enum:voicemail|fax|limit|lowbalance|invoice|callCsv|maxDailyUsage]\'');

        // Create default maxDailyUsage Templates
        $this->addSql('INSERT INTO NotificationTemplates (name, type) VALUES ("Generic Max Daily reached Notification template", "maxDailyUsage")');
        $this->addSql('INSERT INTO NotificationTemplatesContents (
                          fromName,
                          fromAddress,
                          subject,
                          body,
                          notificationTemplateId,
                          languageId
                      ) VALUES (
                        "Notificaciones IvozProvider",
                        "no-reply@ivozprovider.com",
                        "Alerta de consumo máximo de ${MAXDAILYUSAGE_COMPANY}",
                        CONCAT_WS(CHAR(10 using utf8),
                          "Hola ${MAXDAILYUSAGE_COMPANY}!", "",
                          "Su saldo diario máximo ha sido alcanzado y no podrá realizar más llamadas hasta mañana.", "",
                          "    Saldo máximo diario: ${MAXDAILYUSAGE_AMOUNT}", "",
                          "Por favor, póngase en contacto con su administador.", "",
                          "Un saludo,", ""
                          "IvozProvider Balance System"
                        ),
                        (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "maxDailyUsage"),
                        (SELECT id FROM Languages WHERE iden = "es")
                     )');

        $this->addSql('INSERT INTO NotificationTemplatesContents (
                          fromName,
                          fromAddress,
                          subject,
                          body,
                          notificationTemplateId,
                          languageId
                      ) VALUES (
                        "IvozProvider Notifications",
                        "no-reply@ivozprovider.com",
                        "Max daily reached alert for ${MAXDAILYUSAGE_COMPANY}",
                        CONCAT_WS(CHAR(10 using utf8),
                          "Greetings ${MAXDAILYUSAGE_COMPANY}!", "",
                          "Your max daily balance has been reached and you won\'t be able to place more calls until tomorrow.", "",
                          "    Max daily balance: ${MAXDAILYUSAGE_AMOUNT}", "",
                          "Please, contact your administator for further assistance", "",
                          "Best Regards,", ""
                          "IvozProvider Balance System"
                        ),
                        (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "maxDailyUsage"),
                        (SELECT id FROM Languages WHERE iden = "en")
                     )');

        $this->addSql('INSERT INTO NotificationTemplatesContents (
                          fromName,
                          fromAddress,
                          subject,
                          body,
                          notificationTemplateId,
                          languageId
                       ) SELECT 
                          fromName,
                          fromAddress,
                          subject,
                          body,
                          notificationTemplateId,
                         (SELECT id FROM Languages WHERE iden = "ca") 
                        FROM NotificationTemplatesContents 
                         WHERE notificationTemplateId = (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "maxDailyUsage")
                        AND languageId = (SELECT id FROM Languages WHERE iden = "es")
                      ');

        $this->addSql('INSERT INTO NotificationTemplatesContents (
                          fromName,
                          fromAddress,
                          subject,
                          body,
                          notificationTemplateId,
                          languageId
                       ) SELECT 
                          fromName,
                          fromAddress,
                          subject,
                          body,
                          notificationTemplateId,
                         (SELECT id FROM Languages WHERE iden = "it") 
                        FROM NotificationTemplatesContents 
                         WHERE notificationTemplateId = (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "maxDailyUsage")
                        AND languageId = (SELECT id FROM Languages WHERE iden = "en")
                      ');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E4102E81EFEBD');
        $this->addSql('DROP INDEX IDX_790E4102E81EFEBD ON Brands');
        $this->addSql('ALTER TABLE Brands DROP maxDailyUsageNotificationTemplateId');
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899E81EFEBD');
        $this->addSql('DROP INDEX IDX_B52899E81EFEBD ON Companies');
        $this->addSql('ALTER TABLE Companies DROP currentDayUsage, DROP maxDailyUsageEmail, DROP maxDailyUsageNotificationTemplateId');
        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci COMMENT \'[enum:voicemail|fax|limit|lowbalance|invoice|callCsv]\'');
        $this->addSql('DELETE FROM NotificationTemplates WHERE type = "maxDailyUsage"');
    }
}
