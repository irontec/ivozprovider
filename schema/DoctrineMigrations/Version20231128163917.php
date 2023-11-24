<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128163917 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Created new UsersCdr table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE UsersCdrs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, startTime DATETIME DEFAULT NULL, duration DOUBLE PRECISION DEFAULT \'0\' NOT NULL, direction VARCHAR(8) DEFAULT \'outbound\' COMMENT \'[enum:inbound|outbound]\', caller VARCHAR(128) DEFAULT NULL, callee VARCHAR(128) DEFAULT NULL, owner VARCHAR(128) DEFAULT NULL, callid VARCHAR(255) DEFAULT NULL, brandId INT UNSIGNED DEFAULT NULL, disposition VARCHAR(8) DEFAULT \'answered\' COMMENT \'[enum:answered|missed|bussy]\', companyId INT UNSIGNED DEFAULT NULL, userId INT UNSIGNED DEFAULT NULL, friendId INT UNSIGNED DEFAULT NULL, extensionId INT UNSIGNED DEFAULT NULL, kamUsersCdrId INT UNSIGNED DEFAULT NULL, INDEX IDX_CF7F7CAE12AB7F65 (extensionId), INDEX IDX_CF7F7CAEA1A6D577 (kamUsersCdrId), INDEX provider_usersCdr_brandId (brandId), INDEX provider_usersCdr_companyId_startTime (companyId, startTime), INDEX provider_usersCdr_userId (userId), INDEX provider_usersCdr_friendId (friendId), UNIQUE INDEX provider_usersCdr_callid_direction (callid, direction), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE UsersCdrs ADD CONSTRAINT FK_CF7F7CAE2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE UsersCdrs ADD CONSTRAINT FK_CF7F7CAE64B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE UsersCdrs ADD CONSTRAINT FK_CF7F7CAE893BA339 FOREIGN KEY (friendId) REFERENCES Friends (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE UsersCdrs ADD CONSTRAINT FK_CF7F7CAE12AB7F65 FOREIGN KEY (extensionId) REFERENCES Extensions (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE UsersCdrs ADD CONSTRAINT FK_CF7F7CAEA1A6D577 FOREIGN KEY (kamUsersCdrId) REFERENCES kam_users_cdrs (id) ON DELETE SET NULL');

        $this->addSql(
            'UPDATE PublicEntities 
                    SET iden="UsersCdrs", 
                        fqdn="Ivoz\\Provider\\Domain\\Model\\UsersCdr\\UsersCd",
                        platform=0,
                        brand=0, 
                        client=1,
                        name_en="Call registry", 
                        name_es="Registro de llamadas", 
                        name_ca="Registro de llamadas", 
                        name_it="Call registry" 
                 WHERE iden="kam_users_cdrs"'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE UsersCdrs');
    }
}
