<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180108141912 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP VIEW kam_users_domain');
        $this->addSql('CREATE VIEW kam_users_domain AS select Domains.domain AS domain, CAST(Domains.id as char charset utf8) AS did from Domains where (Domains.pointsTo = \'proxyusers\')');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP VIEW kam_users_domain');
        $this->addSql('CREATE VIEW `kam_users_domain` AS select `Domains`.`domain` AS `domain`,NULL AS `did` from `Domains` where (`Domains`.`pointsTo` = \'proxyusers\')');
    }
}
