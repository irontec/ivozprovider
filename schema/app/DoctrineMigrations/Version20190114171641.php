<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190114171641 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'UPDATE Companies SET countryId = (select id from Countries where code = \'ES\') where countryId IS NULL'
        );
        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY Companies_ibfk_9');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B52899FBA2A6B4 FOREIGN KEY (countryId) REFERENCES Countries (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Companies DROP FOREIGN KEY FK_B52899FBA2A6B4');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT Companies_ibfk_9 FOREIGN KEY (countryId) REFERENCES Countries (id) ON DELETE SET NULL');
    }
}
