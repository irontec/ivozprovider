<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200617093620 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE INDEX ddi_ddiE164 ON DDIs (DdiE164)');
        $this->addSql('DROP INDEX tpDestination_tpid ON tp_destinations');
        $this->addSql('CREATE INDEX tpDestination_tag ON tp_destinations (tag)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX ddi_ddiE164 ON DDIs');
        $this->addSql('DROP INDEX tpDestination_tag ON tp_destinations');
        $this->addSql('CREATE INDEX tpDestination_tpid ON tp_destinations (tpid)');
    }
}
