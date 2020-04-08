<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180710081244 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Companies ADD invoiceNotificationTemplateId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B52899A29D8295 FOREIGN KEY (invoiceNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B52899A29D8295 ON Companies (invoiceNotificationTemplateId)');
        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COMMENT \'[enum:voicemail|fax|limit|lowbalance|invoice]\'');

        $this->addSql(
        'INSERT INTO NotificationTemplates (name, type) 
            VALUES ("Generic Invoice Notification Template", "invoice")'
        );

        $this->addSql(
        'INSERT INTO NotificationTemplatesContents (
                  fromName,
                  fromAddress,
                  subject,
                  body,
                  notificationTemplateId,
                  languageId
              ) VALUES (
                "IvozProvider Notifications",
                "no-reply@ivozprovider.com",
                "Invoice available",
                CONCAT_WS(CHAR(10 using utf8),
                  "Greetings ${INVOICE_COMPANY}!", 
                  "",
                  "You already have your invoice available.", 
                  "",
                  "For the period ${INVOICE_DATE_IN} - ${INVOICE_DATE_OUT} ",
                  "the amount is ${INVOICE_AMOUNT}${INVOICE_CURRENCY}.", 
                  "Check out attached file for further details.", 
                  "",
                  "Best Regards,", 
                  "IvozProvider"
                ),
                (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "invoice"),
                (SELECT id FROM Languages WHERE iden = "en")
             )'
        );

        $this->addSql(
            'INSERT INTO NotificationTemplatesContents (
                  fromName,
                  fromAddress,
                  subject,
                  body,
                  notificationTemplateId,
                  languageId
              ) VALUES (
                "Notificaciones IvozProvider",
                "no-reply@ivozprovider.com",
                "Factura disponible",
                CONCAT_WS(CHAR(10 using utf8),
                  "Hola ${INVOICE_COMPANY}!", 
                  "",
                  "Ya tienes disponible tu factura.", 
                  "",
                  "Para el período ${INVOICE_DATE_IN} - ${INVOICE_DATE_OUT} ", 
                  "el importe asciende a ${INVOICE_AMOUNT}${INVOICE_CURRENCY}.",
                  "Consulte el fichero adjunto para más detalles. ", 
                  "",
                  "Atentamente,", 
                  "IvozProvider"
                ),
                (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "invoice"),
                (SELECT id FROM Languages WHERE iden = "es")
             )'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899A29D8295');
        $this->addSql('DROP INDEX IDX_B52899A29D8295 ON Companies');
        $this->addSql('ALTER TABLE Companies DROP invoiceNotificationTemplateId');
        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci COMMENT \'[enum:voicemail|fax|limit|lowbalance]\'');
    }
}
