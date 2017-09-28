<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170914110036 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ast_ps_aors ADD psEndpoint INT UNSIGNED DEFAULT NULL');
        $this->addSql('UPDATE ast_ps_aors SET psEndpoint = id');
        $this->addSql('ALTER TABLE ast_ps_aors MODIFY psEndpoint INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE ast_ps_aors ADD CONSTRAINT FK_96365EB84FBA0BA FOREIGN KEY (psEndpoint) REFERENCES ast_ps_endpoints (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_96365EB84FBA0BA ON ast_ps_aors (psEndpoint)');
        $this->addSql('DROP INDEX id ON ast_ps_aors');
        $this->addSql('ALTER TABLE ast_ps_aors DROP FOREIGN KEY `ast_ps_aors_ibfk_1`');
        $this->addSql('ALTER TABLE ast_ps_aors DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ast_ps_aors DROP id');
        $this->addSql('ALTER TABLE ast_ps_aors ADD PRIMARY KEY (sorcery_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ast_ps_aors DROP FOREIGN KEY FK_96365EB84FBA0BA');
        $this->addSql('DROP INDEX IDX_96365EB84FBA0BA ON ast_ps_aors');
        $this->addSql('ALTER TABLE ast_ps_aors DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ast_ps_aors ADD id INT UNSIGNED NOT NULL FIRST');
        $this->addSql('UPDATE ast_ps_aors SET id = psEndpoint');
        $this->addSql('ALTER TABLE ast_ps_aors ADD CONSTRAINT `ast_ps_aors_ibfk_1` FOREIGN KEY (`id`) REFERENCES `ast_ps_endpoints` (`id`) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ast_ps_aors ADD UNIQUE (id)');
        $this->addSql('ALTER TABLE ast_ps_aors ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE ast_ps_aors DROP psEndpoint');
    }
}
