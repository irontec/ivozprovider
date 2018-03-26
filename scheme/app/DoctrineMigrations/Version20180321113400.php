<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180321113400 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE BalanceNotifications (
                              id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                              toAddress VARCHAR(255) DEFAULT NULL,
                              threshold NUMERIC(10, 4) DEFAULT \'0\',
                              lastSent DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime)\',
                              companyId INT UNSIGNED NOT NULL,
                              notificationTemplateId INT UNSIGNED DEFAULT NULL,
                              INDEX IDX_DD0872322480E723 (companyId),
                              INDEX IDX_DD0872321333F77D (notificationTemplateId),
                              PRIMARY KEY(id)
                          ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('ALTER TABLE BalanceNotifications ADD CONSTRAINT FK_DD0872322480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE BalanceNotifications ADD CONSTRAINT FK_DD0872321333F77D FOREIGN KEY (notificationTemplateId) REFERENCES NotificationTemplates (id) ON DELETE SET NULL');

        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COMMENT \'[enum:voicemail|fax|limit|lowbalance]\'');


        // Create default LowBalance Template
        $this->addSql('INSERT INTO NotificationTemplates (name, type) VALUES ("Generic Low Balance Notification template", "lowbalance")');
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
                        (SELECT id FROM Languages WHERE iden = "en")
                     )');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE BalanceNotifications');
        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci COMMENT \'[enum:voicemail|fax|limit]\'');
        $this->addSql('DELETE FROM NotificationTemplates WHERE type = "lowbalance"');
    }
}
