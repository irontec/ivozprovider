<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620142050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Set uacreg socket field to DDIProvider socket value';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('UPDATE kam_trunks_uacreg KTU JOIN DDIProviderRegistrations DPR ON DPR.id=KTU.ddiProviderRegistrationId JOIN DDIProviders DP ON DP.id=DPR.ddiProviderId LEFT JOIN ProxyTrunks PT ON PT.id=COALESCE(DP.proxyTrunkId, 1) SET socket=CONCAT("udp:", PT.ip, ":5060")');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('UPDATE kam_trunks_uacreg SET socket=NULL');
    }
}
