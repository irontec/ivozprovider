<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200221112255 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD userId INT UNSIGNED DEFAULT NULL, ADD friendId INT UNSIGNED DEFAULT NULL, ADD faxId INT UNSIGNED DEFAULT NULL');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB664B64DCC FOREIGN KEY (userId) REFERENCES Users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB6893BA339 FOREIGN KEY (friendId) REFERENCES Friends (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB6624C8D73 FOREIGN KEY (faxId) REFERENCES Faxes (id) ON DELETE SET NULL');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');

        $this->addSql('CREATE INDEX IDX_92E58EB664B64DCC ON kam_trunks_cdrs (userId)');
        $this->addSql('CREATE INDEX IDX_92E58EB6893BA339 ON kam_trunks_cdrs (friendId)');
        $this->addSql('CREATE INDEX IDX_92E58EB6624C8D73 ON kam_trunks_cdrs (faxId)');

        $this->addSql('ALTER TABLE BillableCalls CHANGE endpointType endpointType VARCHAR(55) DEFAULT NULL COMMENT \'[enum:RetailAccount|ResidentialDevice|User|Friend|Fax]\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BillableCalls CHANGE endpointType endpointType VARCHAR(55) DEFAULT NULL COLLATE utf8_unicode_ci');

        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB664B64DCC');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB6893BA339');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB6624C8D73');
        $this->addSql('DROP INDEX IDX_92E58EB664B64DCC ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX IDX_92E58EB6893BA339 ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX IDX_92E58EB6624C8D73 ON kam_trunks_cdrs');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP userId, DROP friendId, DROP faxId');
    }
}
