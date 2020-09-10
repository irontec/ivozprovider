<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200810142815 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM kam_trusted WHERE companyId IS NULL');
        $this->addSql('ALTER TABLE kam_trusted DROP FOREIGN KEY FK_10A58A572480E723');
        $this->addSql('ALTER TABLE kam_trusted CHANGE companyId companyId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE kam_trusted ADD CONSTRAINT FK_10A58A572480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kam_trusted DROP FOREIGN KEY FK_10A58A572480E723');
        $this->addSql('ALTER TABLE kam_trusted CHANGE companyId companyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE kam_trusted ADD CONSTRAINT FK_10A58A572480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
    }
}
