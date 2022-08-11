<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607135943 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Fix wrong escaped Public entities fqdn';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE PublicEntities
                            SET fqdn = "\\\\Ivoz\\\\Provider\\\\Domain\\\\Model\\\\BannedAddress\\\\BannedAddress"
                            WHERE iden = "BannedAddresses"');
        $this->addSql('UPDATE PublicEntities
                            SET fqdn = "\\\\Ivoz\\\\Provider\\\\Domain\\\\Model\\\\Location\\\\Location"
                            WHERE iden = "Locations"');
        $this->addSql('UPDATE PublicEntities
                            SET fqdn = "\\\\Ivoz\\\\Provider\\\\Domain\\\\Model\\\\VoicemailMessage\\\\VoicemailMessage"
                            WHERE iden = "VoicemailMessages"');
        $this->addSql('UPDATE PublicEntities
                            SET fqdn = "\\\\Ivoz\\\\Provider\\\\Domain\\\\Model\\\\Voicemail\\\\Voicemail"
                            WHERE iden = "Voicemails"');
    }

    public function down(Schema $schema): void
    {
    }
}
