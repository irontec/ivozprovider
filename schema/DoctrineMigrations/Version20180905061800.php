<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180905061800 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'CREATE TABLE CallCsvSchedulers (
              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
              name VARCHAR(40) NOT NULL,
              unit VARCHAR(30) DEFAULT \'month\' NOT NULL COMMENT \'[enum:week|month|year]\',
              frequency SMALLINT UNSIGNED NOT NULL,
              email VARCHAR(140) NOT NULL,
              lastExecution DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\',
              nextExecution DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\',
              brandId INT UNSIGNED DEFAULT NULL,
              companyId INT UNSIGNED NOT NULL,
              INDEX IDX_100E171E9CBEC244 (brandId),
              INDEX IDX_100E171E2480E723 (companyId),
              UNIQUE INDEX CallCsvScheduler_name_brand (name, brandId),
              PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE CallCsvReports (
              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
              sentTo VARCHAR(250) DEFAULT \'\' NOT NULL,
              inDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime)\',
              outDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime)\',
              createdOn DATETIME NOT NULL COMMENT \'(DC2Type:datetime)\',
              csvFileSize INT UNSIGNED DEFAULT NULL COMMENT \'[FSO]\',
              csvMimeType VARCHAR(80) DEFAULT NULL,
              csvBaseName VARCHAR(255) DEFAULT NULL,
              companyId INT UNSIGNED DEFAULT NULL,
              callCsvSchedulerId INT UNSIGNED DEFAULT NULL,
              INDEX IDX_3DC217432480E723 (companyId),
              INDEX IDX_3DC217431A2D1FF1 (callCsvSchedulerId),
              PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CallCsvSchedulers ADD CONSTRAINT FK_100E171E2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CallCsvReports ADD CONSTRAINT FK_3DC217432480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE CallCsvReports ADD CONSTRAINT FK_3DC217431A2D1FF1 FOREIGN KEY (callCsvSchedulerId) REFERENCES CallCsvSchedulers (id) ON DELETE SET NULL');

        // Create an API user for scheduled jobs
        $this->addSql("SET SESSION sql_mode='NO_AUTO_VALUE_ON_ZERO'");
        $this->addSql("REPLACE INTO Administrators(id, username, pass, active) VALUES (0, 'privateAdmin', '', 0)");

        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COMMENT \'[enum:voicemail|fax|limit|lowbalance|invoice|callCsv]\'');

        $this->addSql(
            'INSERT INTO NotificationTemplates (name, type) VALUES ("Generic Call CSV Notification template", "callCsv")'
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
                (SELECT id FROM Languages WHERE iden = "es")
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
                (SELECT id FROM Languages WHERE iden = "en")
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

        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COMMENT \'[enum:voicemail|fax|limit|lowbalance|invoice]\'');
        $this->addSql('DELETE FROM NotificationTemplates WHERE TYPE= \'callCsv\'');

        $this->addSql('ALTER TABLE CallCsvReports DROP FOREIGN KEY FK_3DC217431A2D1FF1');
        $this->addSql('DROP TABLE CallCsvSchedulers');
        $this->addSql('DROP TABLE CallCsvReports');
    }
}
