<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190912162641 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
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
                "Nuevo informe de llamadas",
                CONCAT_WS(CHAR(10 using utf8),
                 "Hola ${CALLCSV_COMPANY}!", 
                 "",
                 "Ya tienes disponible tu factura informe de llamadas para el período ${CALLCSV_DATE_IN} - ${CALLCSV_DATE_OUT}.",
                 "",
                 "Consulte el fichero adjunto para más detalles. ", 
                 "",
                 "Atentamente,",
                 "IvozProvider"
                ),
                (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "callCsv"),
                (SELECT id FROM Languages WHERE iden = "ca")
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
                (SELECT id FROM Languages WHERE iden = "ca")
             )'
        );

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
                        "Nuevo mensaje en el buzón de voz de ${VM_CIDNAME} (${VM_CIDNUM})",
                        CONCAT_WS(CHAR(10 using utf8),
                          "Hola ${VM_NAME}!", "",
                          "${VM_CIDNAME} (${VM_CIDNUM}) te ha dejado un mensaje en tú buzón de voz.", "",
                          "    Día: ${VM_DATE}",
                          "    Duración: ${VM_DUR}", "",
                          "Un saludo,", ""
                          "IvozProvider Mailbox System"
                        ),
                        (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "voicemail"),
                        (SELECT id FROM Languages WHERE iden = "ca")
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
                        "Nuevo Fax desde ${FAX_SRC} recibido en ${FAX_NAME} (${FAX_DST})",
                        CONCAT_WS(CHAR(10 using utf8),
                          "Buenas,", "",
                          "Un nuevo Fax ha sido recibido en ${FAX_NAME} (ver adjunto).", "",
                          "    Fecha: ${FAX_DATE}",
                          "    Nombre: ${FAX_PDFNAME}",
                          "    Páginas: ${FAX_PAGES}", "",
                          "Un saludo,", ""
                          "IvozProvider Virtual Fax System"
                        ),
                        (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "fax"),
                        (SELECT id FROM Languages WHERE iden = "ca")
                     )');

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
                        "Alerta de saldo de ${BALANCE_COMPANY}",
                        CONCAT_WS(CHAR(10 using utf8),
                          "Hola ${BALANCE_COMPANY}!", "",
                          "Su saldo está a punto de agotarse. Cuando esto ocurra no podrá realizar más llamadas", "",
                          "    Saldo: ${BALANCE_AMOUNT}", ""
                          "Por favor, póngase en contacto con su administador para aumentar su saldo", "",
                          "Un saludo,", ""
                          "IvozProvider Balance System"
                        ),
                        (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "lowbalance"),
                        (SELECT id FROM Languages WHERE iden = "ca")
                     )');

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
                "New call report",
                CONCAT_WS(CHAR(10 using utf8),
                 "Greetings ${CALLCSV_COMPANY}!",
                 "",
                 "You already have your call report for the period ${CALLCSV_DATE_IN} - ${CALLCSV_DATE_OUT} available.",
                 "",
                 "Check out attached file for further details.",
                 "",
                 "Best Regards,",
                 "IvozProvider"
                ),
                (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "callCsv"),
                (SELECT id FROM Languages WHERE iden = "it")
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
                (SELECT id FROM Languages WHERE iden = "it")
             )'
        );

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
                        "New voicemail from ${VM_CIDNAME} (${VM_CIDNUM})",
                        CONCAT_WS(CHAR(10 using utf8),
                          "Greetings ${VM_NAME}!", "",
                          "You have a new voicemail from ${VM_CIDNAME} (${VM_CIDNUM}) waiting!", "",
                          "    Day: ${VM_DATE}",
                          "    Duration: ${VM_DUR}", "",
                          "Best Regards,", ""
                          "IvozProvider Mailbox System"
                        ),
                        (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "voicemail"),
                        (SELECT id FROM Languages WHERE iden = "it")
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
                        "New Fax from ${FAX_SRC} received in ${FAX_NAME} (${FAX_DST})",
                        CONCAT_WS(CHAR(10 using utf8),
                          "Greetings!", "",
                          "A new fax has been received at ${FAX_NAME} (see attachment).", "",
                          "    Date: ${FAX_DATE}",
                          "    Name: ${FAX_PDFNAME}",
                          "    Pages: ${FAX_PAGES}", "",
                          "Best Regards,", ""
                          "IvozProvider Virtual Fax System"
                        ),
                        (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "fax"),
                        (SELECT id FROM Languages WHERE iden = "it")
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
                        "Low balance alerts for ${BALANCE_COMPANY}",
                        CONCAT_WS(CHAR(10 using utf8),
                          "Greetings ${BALANCE_COMPANY}!", "",
                          "Your balance is about to run out. If that happens you won\'t be able to place more calls.", "",
                          "    Balance: ${BALANCE_AMOUNT}", ""
                          "Please, contact your administator to increase your balance", "",
                          "Best Regards,", ""
                          "IvozProvider Balance System"
                        ),
                        (SELECT id FROM NotificationTemplates WHERE brandId IS NULL and type = "lowbalance"),
                        (SELECT id FROM Languages WHERE iden = "it")
                     )');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
