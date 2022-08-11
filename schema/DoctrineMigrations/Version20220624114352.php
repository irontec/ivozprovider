<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220624114352 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Set contactAddr value for uacreg entries';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('UPDATE kam_trunks_uacreg KTU JOIN DDIProviderRegistrations DPR ON DPR.id=KTU.ddiProviderRegistrationId JOIN DDIProviders DP ON DP.id=DPR.ddiProviderId LEFT JOIN ProxyTrunks PT ON PT.id=COALESCE(DP.proxyTrunkId, 1) SET contact_addr=CONCAT(PT.ip, ":5060")');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("UPDATE kam_trunks_uacreg SET contact_addr=''");
    }
}
