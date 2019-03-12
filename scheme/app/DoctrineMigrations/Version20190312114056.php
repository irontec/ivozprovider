<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190312114056 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // Add all features to Brand 1
        $this->addSql("INSERT IGNORE INTO FeaturesRelBrands (brandId, featureId) SELECT 1, id FROM Features");

        // Update Brand domain only if it has no domain assigned
        $this->addSql("UPDATE Brands SET domain_users = 'brand.domain.invalid' WHERE id = 1 and domainId IS NULL");

        // Add a new entry in Domains table only if DemoBrand has new assigned domain
        $this->addSql("INSERT IGNORE INTO Domains (domain, pointsTo, description)
                              SELECT domain_users, 'proxyusers', CONCAT(name, ' proxyusers domain')
                                FROM Brands WHERE id = 1 and domain_users = 'brand.domain.invalid'");

        // Update Brand domainId field only if has new assigned domain 
        $this->addSql("UPDATE Brands SET domainId = (SELECT id FROM Domains WHERE domain = 'brand.domain.invalid')
                              WHERE domain_users = 'brand.domain.invalid'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        /** Nothing to do here **/
    }
}
