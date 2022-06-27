<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627155554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove obsolete kam_users_cdrs fields';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kam_users_cdrs DROP FOREIGN KEY FK_238F735B5EA9D64D');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP FOREIGN KEY FK_238F735B8B329DCD');
        $this->addSql('DROP INDEX IDX_238F735B5EA9D64D ON kam_users_cdrs');
        $this->addSql('DROP INDEX usersCdr_residentialDeviceId ON kam_users_cdrs');
        $this->addSql('CREATE INDEX usersCdr_companyId_startTime ON kam_users_cdrs (companyId, start_time)');
        $this->addSql('DROP INDEX usersCdr_companyId_hidden_startTime ON kam_users_cdrs');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP residentialDeviceId, DROP retailAccountId, DROP hidden');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kam_users_cdrs ADD residentialDeviceId INT UNSIGNED DEFAULT NULL, ADD retailAccountId INT UNSIGNED DEFAULT NULL, ADD hidden TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('CREATE INDEX usersCdr_companyId_hidden_startTime ON kam_users_cdrs (companyId, hidden, start_time)');
        $this->addSql('DROP INDEX usersCdr_companyId_startTime ON kam_users_cdrs');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B5EA9D64D FOREIGN KEY (retailAccountId) REFERENCES RetailAccounts (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B8B329DCD FOREIGN KEY (residentialDeviceId) REFERENCES ResidentialDevices (id) ON UPDATE NO ACTION ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_238F735B5EA9D64D ON kam_users_cdrs (retailAccountId)');
        $this->addSql('CREATE INDEX usersCdr_residentialDeviceId ON kam_users_cdrs (residentialDeviceId)');
    }
}
