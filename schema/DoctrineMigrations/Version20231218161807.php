<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218161807 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Added accessCredentials in Notification Templates';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COMMENT \'[enum:voicemail|fax|limit|lowbalance|invoice|callCsv|maxDailyUsage|accessCredentials]\'');
        $this->addSql("INSERT INTO NotificationTemplates (name, type) VALUES ('Generic Access Credentials Notification Template', 'accessCredentials')");
        $this->addSql('INSERT INTO `NotificationTemplatesContents` (
                                        `fromName`,
                                        `fromAddress`,
                                        `subject`,
                                        `body`,
                                        `notificationTemplateId`,
                                        `languageId`,
                                        `bodyType`
                                        ) VALUES (
                                            \'Notificaciones IvozProvider\',
                                            \'no-reply@ivozprovider.com\',
                                            \'Credenciales de acceso IvozProvider\', 
                                            \'A continuación se le indican las credenciales de acceso para el portal de administración de Ivoz Provider:\n\n\n Usuario: ${USER}\n Contraseña: ${PASSWORD} \n\nAtentamente,\nIvozProvider\n\',  
                                            (SELECT id FROM NotificationTemplates WHERE type=\'accessCredentials\'),
                                            (SELECT id FROM Languages WHERE iden = \'es\'),
                                            \'text/plain\'
                                        )'
        );

        $this->addSql('INSERT INTO `NotificationTemplatesContents` (
                                        `fromName`,
                                        `fromAddress`,
                                        `subject`,
                                        `body`,
                                        `notificationTemplateId`,
                                        `languageId`,
                                        `bodyType`
                                        ) VALUES (
                                            \'IvozProvider Notifications\',
                                            \'no-reply@ivozprovider.com\',
                                            \'IvozProvider Access Credentials\', 
                                              \'Below are the access credentials for the administration portal of Ivoz Provider:\n\n\n User: ${USER}\n Password: ${PASSWORD} \n\nBest Regards,\nIvozProvider\n\', 
                                            (SELECT id FROM NotificationTemplates WHERE type=\'accessCredentials\'),
                                            (SELECT id FROM Languages WHERE iden = \'en\'),
                                            \'text/plain\'
                                        )'
        );

        $this->addSql('INSERT INTO `NotificationTemplatesContents` (
                                        `fromName`,
                                        `fromAddress`,
                                        `subject`,
                                        `body`,
                                        `notificationTemplateId`,
                                        `languageId`,
                                        `bodyType`
                                        ) VALUES (
                                            \'Notificaciones IvozProvider\',
                                            \'no-reply@ivozprovider.com\',
                                            \'Credenciales de acceso IvozProvider\', 
                                            \'A continuación se le indican las credenciales de acceso para el portal de administración de Ivoz Provider:\n\n\n Usuario: ${USER}\n Contraseña: ${PASSWORD} \n\nAtentamente,\nIvozProvider\n\', 
                                            (SELECT id FROM NotificationTemplates WHERE type=\'accessCredentials\'),
                                            (SELECT id FROM Languages WHERE iden = \'ca\'),
                                            \'text/plain\'
                                        )'
        );

        $this->addSql('INSERT INTO `NotificationTemplatesContents` (
                                        `fromName`,
                                        `fromAddress`,
                                        `subject`,
                                        `body`,
                                        `notificationTemplateId`,
                                        `languageId`,
                                        `bodyType`
                                        ) VALUES (
                                            \'IvozProvider Notifications\',
                                            \'no-reply@ivozprovider.com\',
                                            \'IvozProvider Access Credentials\', 
                                            \'Below are the access credentials for the administration portal of Ivoz Provider:\n\n\n User: ${USER}\n Password: ${PASSWORD} \n\nBest Regards,\nIvozProvider\n\', 
                                            (SELECT id FROM NotificationTemplates WHERE type=\'accessCredentials\'),
                                            (SELECT id FROM Languages WHERE iden = \'it\'),
                                            \'text/plain\'
                                        )'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM NotificationTemplates WHERE  type=\'accessCredentials\'');
        $this->addSql('ALTER TABLE NotificationTemplates CHANGE type type VARCHAR(25) NOT NULL COMMENT \'[enum:voicemail|fax|limit|lowbalance|invoice|callCsv|maxDailyUsage]\'');
    }
}
