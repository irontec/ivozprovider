<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20201106131908 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO Countries (code, name_en, name_es, name_ca, name_it, zone_en, zone_es, zone_ca, zone_it, countryCode) VALUES ('UIFN', 'Universal International Freephone Number' , 'Número internacional del servicio de llamada gratuita universal', 'Números internacionals gratuïts', 'Numeri gratuiti internazionali', 'Universal', 'Universal', 'Universal', 'Universal', '+800')");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM Countries WHERE code='UIFN'");
    }
}
