<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180718132230 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        // Create a Brand feature to enable this client type
        $this->addSql('INSERT INTO Features (id, iden, name_en, name_es) VALUES (12, "vpbx", "vPBX Clients", "Clientes vPBX")');
        // Enable this feature for all existing Brands
        $this->addSql('INSERT INTO FeaturesRelBrands (brandId, featureId) SELECT id, 12 FROM Brands');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM Features WHERE id = 12');
    }
}
