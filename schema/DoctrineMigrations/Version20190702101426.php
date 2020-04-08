<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190702101426 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX ddiProviderRegistration_username_domain ON DDIProviderRegistrations (username, domain)');
        $this->addSql('ALTER TABLE HolidayDates DROP FOREIGN KEY FK_4C571280AF230FFD');
        $this->addSql('ALTER TABLE HolidayDates ADD CONSTRAINT FK_4C571280AF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX ddiProviderRegistration_username_domain ON DDIProviderRegistrations');
        $this->addSql('ALTER TABLE HolidayDates DROP FOREIGN KEY FK_4C571280AF230FFD');
        $this->addSql('ALTER TABLE HolidayDates ADD CONSTRAINT FK_4C571280AF230FFD FOREIGN KEY (voiceMailUserId) REFERENCES Users (id) ON DELETE CASCADE');
    }
}
