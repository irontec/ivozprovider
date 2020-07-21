<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200721074242 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ast_ps_endpoints DROP INDEX psEndpoint_terminalId, ADD UNIQUE INDEX psEndpoint_terminal (terminalId)');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP INDEX psEndpoint_friendId, ADD UNIQUE INDEX psEndpoint_friend (friendId)');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP INDEX IDX_800B60518B329DCD, ADD UNIQUE INDEX psEndpoint_residential_device (residentialDeviceId)');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP INDEX IDX_800B60515EA9D64D, ADD UNIQUE INDEX psEndpoint_retail_account (retailAccountId)');
        $this->addSql('ALTER TABLE ast_voicemail DROP INDEX voicemail_userId, ADD UNIQUE INDEX voicemail_user (userId)');
        $this->addSql('ALTER TABLE ast_voicemail DROP INDEX IDX_B2AD1D0A8B329DCD, ADD UNIQUE INDEX voicemail_residential_device (residentialDeviceId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ast_ps_endpoints DROP INDEX psEndpoint_terminal, ADD INDEX psEndpoint_terminalId (terminalId)');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP INDEX psEndpoint_friend, ADD INDEX psEndpoint_friendId (friendId)');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP INDEX psEndpoint_residential_device, ADD INDEX IDX_800B60518B329DCD (residentialDeviceId)');
        $this->addSql('ALTER TABLE ast_ps_endpoints DROP INDEX psEndpoint_retail_account, ADD INDEX IDX_800B60515EA9D64D (retailAccountId)');
        $this->addSql('ALTER TABLE ast_voicemail DROP INDEX voicemail_user, ADD INDEX voicemail_userId (userId)');
        $this->addSql('ALTER TABLE ast_voicemail DROP INDEX voicemail_residential_device, ADD INDEX IDX_B2AD1D0A8B329DCD (residentialDeviceId)');
    }
}
