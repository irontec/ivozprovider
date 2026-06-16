<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

final class Version20260518112632 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add on-demand recording email delivery: columns on Companies, FKs to NotificationTemplates and generic onDemandRecord template';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE Companies ADD onDemandRecordEmail VARCHAR(25) DEFAULT 'disabled' NOT NULL COMMENT '[enum:disabled|user|other]', ADD onDemandRecordEmailAddress VARCHAR(100) DEFAULT NULL, ADD onDemandRecordNotificationTemplateId INT UNSIGNED DEFAULT NULL");
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B52899AA1E7C28 FOREIGN KEY (onDemandRecordNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B52899AA1E7C28 ON Companies (onDemandRecordNotificationTemplateId)');

        $this->addSql('ALTER TABLE Brands ADD onDemandRecordNotificationTemplateId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E4102AA1E7C28 FOREIGN KEY (onDemandRecordNotificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_790E4102AA1E7C28 ON Brands (onDemandRecordNotificationTemplateId)');

        $this->addSql("ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COMMENT '[enum:voicemail|fax|limit|lowbalance|invoice|callCsv|maxDailyUsage|accessCredentials|onDemandRecord]'");

        $this->addSql("INSERT INTO NotificationTemplates (name, type) VALUES ('Generic On Demand Recording Notification Template', 'onDemandRecord')");

        $this->addSql("INSERT INTO `NotificationTemplatesContents` (
                                    `fromName`,
                                    `fromAddress`,
                                    `subject`,
                                    `body`,
                                    `notificationTemplateId`,
                                    `languageId`,
                                    `bodyType`
                                ) VALUES (
                                    'Notificaciones IvozProvider',
                                    'no-reply@ivozprovider.com',
                                    'Grabación on-demand',
                                    'Adjunta encontrará la grabación on-demand de la llamada.\n\nEmpresa: \${RECORD_COMPANY}\nOrigen: \${RECORD_CALLER}\nDestino: \${RECORD_CALLEE}\nFecha: \${RECORD_DATE}\nDuración: \${RECORD_DURATION} segundos\n\nAtentamente,\nIvozProvider\n',
                                    (SELECT id FROM NotificationTemplates WHERE type='onDemandRecord' AND brandId IS NULL),
                                    (SELECT id FROM Languages WHERE iden = 'es'),
                                    'text/plain'
                                )");

        $this->addSql("INSERT INTO `NotificationTemplatesContents` (
                                    `fromName`,
                                    `fromAddress`,
                                    `subject`,
                                    `body`,
                                    `notificationTemplateId`,
                                    `languageId`,
                                    `bodyType`
                                ) VALUES (
                                    'IvozProvider Notifications',
                                    'no-reply@ivozprovider.com',
                                    'On-demand recording',
                                    'Attached you will find the on-demand recording of the call.\n\nCompany: \${RECORD_COMPANY}\nCaller: \${RECORD_CALLER}\nCallee: \${RECORD_CALLEE}\nDate: \${RECORD_DATE}\nDuration: \${RECORD_DURATION} seconds\n\nBest Regards,\nIvozProvider\n',
                                    (SELECT id FROM NotificationTemplates WHERE type='onDemandRecord' AND brandId IS NULL),
                                    (SELECT id FROM Languages WHERE iden = 'en'),
                                    'text/plain'
                                )");

        $this->addSql("INSERT INTO `NotificationTemplatesContents` (
                                    `fromName`,
                                    `fromAddress`,
                                    `subject`,
                                    `body`,
                                    `notificationTemplateId`,
                                    `languageId`,
                                    `bodyType`
                                ) VALUES (
                                    'Notificacions IvozProvider',
                                    'no-reply@ivozprovider.com',
                                    'Gravació on-demand',
                                    'Adjunta trobareu la gravació on-demand de la trucada.\n\nEmpresa: \${RECORD_COMPANY}\nOrigen: \${RECORD_CALLER}\nDestí: \${RECORD_CALLEE}\nData: \${RECORD_DATE}\nDurada: \${RECORD_DURATION} segons\n\nAtentament,\nIvozProvider\n',
                                    (SELECT id FROM NotificationTemplates WHERE type='onDemandRecord' AND brandId IS NULL),
                                    (SELECT id FROM Languages WHERE iden = 'ca'),
                                    'text/plain'
                                )");

        $this->addSql("INSERT INTO `NotificationTemplatesContents` (
                                    `fromName`,
                                    `fromAddress`,
                                    `subject`,
                                    `body`,
                                    `notificationTemplateId`,
                                    `languageId`,
                                    `bodyType`
                                ) VALUES (
                                    'Notifiche IvozProvider',
                                    'no-reply@ivozprovider.com',
                                    'Registrazione on-demand',
                                    'In allegato troverai la registrazione on-demand della chiamata.\n\nAzienda: \${RECORD_COMPANY}\nChiamante: \${RECORD_CALLER}\nDestinatario: \${RECORD_CALLEE}\nData: \${RECORD_DATE}\nDurata: \${RECORD_DURATION} secondi\n\nCordiali saluti,\nIvozProvider\n',
                                    (SELECT id FROM NotificationTemplates WHERE type='onDemandRecord' AND brandId IS NULL),
                                    (SELECT id FROM Languages WHERE iden = 'it'),
                                    'text/plain'
                                )");

        $this->addSql("INSERT INTO `NotificationTemplatesContents` (
                                    `fromName`,
                                    `fromAddress`,
                                    `subject`,
                                    `body`,
                                    `notificationTemplateId`,
                                    `languageId`,
                                    `bodyType`
                                ) VALUES (
                                    'IvozProvider Jakinarazpenak',
                                    'no-reply@ivozprovider.com',
                                    'Eskaerako grabazioa',
                                    'Atxikita aurkituko duzu eskaerako deiaren grabazioa.\n\nEnpresa: \${RECORD_COMPANY}\nDeitzailea: \${RECORD_CALLER}\nHartzailea: \${RECORD_CALLEE}\nData: \${RECORD_DATE}\nIraupena: \${RECORD_DURATION} segundo\n\nAgur bero bat,\nIvozProvider\n',
                                    (SELECT id FROM NotificationTemplates WHERE type='onDemandRecord' AND brandId IS NULL),
                                    (SELECT id FROM Languages WHERE iden = 'eu'),
                                    'text/plain'
                                )");
    }

    public function down(Schema $schema): void
    {
        // Remove generic template (contents are cascaded)
        $this->addSql("DELETE FROM NotificationTemplates WHERE type='onDemandRecord' AND brandId IS NULL");

        // Restore enum without onDemandRecord
        $this->addSql("ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COMMENT '[enum:voicemail|fax|limit|lowbalance|invoice|callCsv|maxDailyUsage|accessCredentials]'");

        // Brands FK
        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E4102AA1E7C28');
        $this->addSql('DROP INDEX IDX_790E4102AA1E7C28 ON Brands');
        $this->addSql('ALTER TABLE Brands DROP onDemandRecordNotificationTemplateId');

        // Companies FK + columns
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899AA1E7C28');
        $this->addSql('DROP INDEX IDX_B52899AA1E7C28 ON Companies');
        $this->addSql('ALTER TABLE Companies DROP onDemandRecordEmail, DROP onDemandRecordEmailAddress, DROP onDemandRecordNotificationTemplateId');
    }
}
