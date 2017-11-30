<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171130125757 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kam_users_cdrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, start_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', end_time DATETIME DEFAULT \'2000-01-01 00:00:00\' NOT NULL COMMENT \'(DC2Type:datetime)\', duration DOUBLE PRECISION DEFAULT \'0.000\' NOT NULL, direction VARCHAR(255) DEFAULT NULL, caller VARCHAR(128) DEFAULT NULL, callee VARCHAR(128) DEFAULT NULL, diversion VARCHAR(64) DEFAULT NULL, referee VARCHAR(128) DEFAULT NULL, referrer VARCHAR(128) DEFAULT NULL, callid VARCHAR(255) DEFAULT NULL, callidHash VARCHAR(128) DEFAULT NULL, xcallid VARCHAR(255) DEFAULT NULL, brandId INT UNSIGNED DEFAULT NULL, companyId INT UNSIGNED DEFAULT NULL, userId INT UNSIGNED DEFAULT NULL, friendId INT UNSIGNED DEFAULT NULL, retailAccountId INT UNSIGNED DEFAULT NULL, INDEX start_time_idx (start_time), INDEX end_time_idx (end_time), INDEX callid_idx (callid), INDEX xcallid_idx (xcallid), INDEX brandId (brandId), INDEX companyId (companyId), INDEX userId (userId), INDEX friendId (friendId), INDEX retailAccountId (retailAccountId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B64B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B893BA339 FOREIGN KEY (friendId) REFERENCES Friends (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B5EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON DELETE SET NULL');

        // Populate new table with previus data
        // -- Calculate userId from callee in outbound calls
        $this->addSql('INSERT INTO `kam_users_cdrs` (start_time, end_time, duration, brandId, companyId, direction, caller, callee, diversion, referee, referrer, callid, callidHash, xcallid, userId) SELECT start_time, end_time, TRUNCATE(duration, 3), brandId, kac.companyId, direction, caller, callee, diversion, referee, referrer, callid, callidHash, xcallid, U.id FROM kam_acc_cdrs kac LEFT JOIN Extensions E ON E.number=kac.callee LEFT JOIN Users U ON U.extensionId=E.id WHERE proxy=\'USER\' AND direction=\'inbound\'');

        // -- Calculate userId from caller in inbound calls
        $this->addSql('INSERT INTO `kam_users_cdrs` (start_time, end_time, duration, brandId, companyId, direction, caller, callee, diversion, referee, referrer, callid, callidHash, xcallid, userId) SELECT start_time, end_time, TRUNCATE(duration, 3), brandId, kac.companyId, direction, caller, callee, diversion, referee, referrer, callid, callidHash, xcallid, U.id FROM kam_acc_cdrs kac LEFT JOIN Extensions E ON E.number=kac.caller LEFT JOIN Users U ON U.extensionId=E.id WHERE proxy=\'USER\' AND direction=\'outbound\'');

        $this->addSql('DELETE FROM kam_acc_cdrs WHERE proxy=\'USER\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Populate old table with previus data
        $this->addSql('INSERT INTO `kam_acc_cdrs` (proxy, start_time, end_time, duration, brandId, companyId, direction, caller, callee, diversion, referee, referrer, callid, callidHash, xcallid) SELECT \'USER\', start_time, end_time, duration, brandId, companyId, direction, caller, callee, diversion, referee, referrer, callid, callidHash, xcallid FROM kam_users_cdrs');
        $this->addSql('DROP TABLE kam_users_cdrs');
    }
}
