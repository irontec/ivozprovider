<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180807142455 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Carriers ADD balance NUMERIC(10, 4) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE BalanceNotifications DROP FOREIGN KEY FK_DD0872322480E723');
        $this->addSql('ALTER TABLE BalanceNotifications ADD carrierId INT UNSIGNED DEFAULT NULL, CHANGE companyId companyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE BalanceNotifications ADD CONSTRAINT FK_DD0872326709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE BalanceNotifications ADD CONSTRAINT FK_DD0872322480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_DD0872326709B1C ON BalanceNotifications (carrierId)');
        $this->addSql('ALTER TABLE BalanceMovements DROP FOREIGN KEY FK_758E03912480E723');
        $this->addSql('ALTER TABLE BalanceMovements ADD carrierId INT UNSIGNED DEFAULT NULL, CHANGE companyId companyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE BalanceMovements ADD CONSTRAINT FK_A8AD782F2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE BalanceMovements ADD CONSTRAINT FK_A8AD782F6709B1C FOREIGN KEY (carrierId) REFERENCES Carriers (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A8AD782F6709B1C ON BalanceMovements (carrierId)');

        $this->addSql('UPDATE NotificationTemplatesContents SET body = REPLACE(body, \'${BALANCE_COMPANY}\', \'${BALANCE_NAME}\')');
        $this->addSql('UPDATE NotificationTemplatesContents SET subject = REPLACE(subject, \'${BALANCE_COMPANY}\', \'${BALANCE_NAME}\')');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BalanceMovements DROP FOREIGN KEY FK_A8AD782F2480E723');
        $this->addSql('ALTER TABLE BalanceMovements DROP FOREIGN KEY FK_A8AD782F6709B1C');
        $this->addSql('DROP INDEX IDX_A8AD782F6709B1C ON BalanceMovements');
        $this->addSql('ALTER TABLE BalanceMovements DROP carrierId');
        $this->addSql('ALTER TABLE BalanceMovements CHANGE companyId companyId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE BalanceMovements ADD CONSTRAINT FK_758E03912480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE BalanceNotifications DROP FOREIGN KEY FK_DD0872326709B1C');
        $this->addSql('ALTER TABLE BalanceNotifications DROP FOREIGN KEY FK_DD0872322480E723');
        $this->addSql('DROP INDEX IDX_DD0872326709B1C ON BalanceNotifications');
        $this->addSql('ALTER TABLE BalanceNotifications DROP carrierId');
        $this->addSql('ALTER TABLE BalanceNotifications CHANGE companyId companyId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE BalanceNotifications ADD CONSTRAINT FK_DD0872322480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Carriers DROP balance');

        $this->addSql('UPDATE NotificationTemplatesContents SET body = REPLACE(body, \'${BALANCE_NAME}\', \'${BALANCE_COMPANY}\')');
        $this->addSql('UPDATE NotificationTemplatesContents SET subject = REPLACE(subject, \'${BALANCE_NAME}\', \'${BALANCE_COMPANY}\')');
    }
}
