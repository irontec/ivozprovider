<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180314120551 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE NotificationTemplatesContents (
                          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                          fromName VARCHAR(255) DEFAULT NULL,
                          fromAddress VARCHAR(255) DEFAULT NULL,
                          subject VARCHAR(255) NOT NULL,
                          body TEXT NOT NULL,
                          notificationTemplateId INT UNSIGNED NOT NULL,
                          languageId INT UNSIGNED DEFAULT NULL,
                          INDEX IDX_AD99291D1333F77D (notificationTemplateId),
                          INDEX IDX_AD99291D940D8C7E (languageId),
                          UNIQUE INDEX notificationTemplateContent_language_unique (notificationTemplateId, languageId),
                          PRIMARY KEY(id)
                        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('CREATE TABLE NotificationTemplates (
                          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                          name VARCHAR(55) NOT NULL,
                          type VARCHAR(25) NOT NULL COMMENT \'[enum:voicemail|fax|limit]\',
                          brandId INT UNSIGNED DEFAULT NULL,
                          INDEX IDX_1C1A7309CBEC244 (brandId),
                          UNIQUE INDEX notificationTemplate_name_brand (name, brandId),
                          PRIMARY KEY(id)
                        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('ALTER TABLE NotificationTemplatesContents ADD CONSTRAINT FK_AD99291D1333F77D FOREIGN KEY (notificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE NotificationTemplatesContents ADD CONSTRAINT FK_AD99291D940D8C7E FOREIGN KEY (languageId) REFERENCES Languages (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE NotificationTemplates ADD CONSTRAINT FK_1C1A7309CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');

        // Create default Voicemail Template
        $this->addSql('INSERT INTO NotificationTemplates (name, type) VALUES ("Generic Voicemail Notification template", "voicemail")');
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
                        (SELECT id FROM Languages WHERE iden = "en")
                     )');


        $this->addSql('INSERT INTO NotificationTemplates (name, type) VALUES ("Generic Fax Notification template", "fax")');
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
                        (SELECT id FROM Languages WHERE iden = "en")
                     )');

        $this->addSql('ALTER TABLE Brands DROP FromName, DROP FromAddress');
        $this->addSql('ALTER TABLE Companies ADD vmNotificationTemplateId INT UNSIGNED DEFAULT NULL, ADD faxNotificationTemplateId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B528991BA12A15 FOREIGN KEY (vmNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B52899E559D278 FOREIGN KEY (faxNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B528991BA12A15 ON Companies (vmNotificationTemplateId)');
        $this->addSql('CREATE INDEX IDX_B52899E559D278 ON Companies (faxNotificationTemplateId)');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands ADD FromName VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, ADD FromAddress VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B528991BA12A15');
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899E559D278');
        $this->addSql('DROP INDEX IDX_B528991BA12A15 ON Companies');
        $this->addSql('DROP INDEX IDX_B52899E559D278 ON Companies');
        $this->addSql('ALTER TABLE Companies DROP vmNotificationTemplateId, DROP faxNotificationTemplateId');

        $this->addSql('ALTER TABLE NotificationTemplatesContents DROP FOREIGN KEY FK_AD99291D1333F77D');
        $this->addSql('DROP TABLE NotificationTemplatesContents');
        $this->addSql('DROP TABLE NotificationTemplates');
    }
}
