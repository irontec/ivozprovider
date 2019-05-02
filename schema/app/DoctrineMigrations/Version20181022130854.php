<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181022130854 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("UPDATE CallForwardSettings CFS
                            INNER JOIN ResidentialDevices RD ON RD.id = CFS.residentialDeviceId
                            INNER JOIN Companies C ON C.id = RD.companyId
                          SET numberCountryId = C.countryId");

        $this->addSql("UPDATE CallForwardSettings CFS
                            INNER JOIN Users U ON U.id = CFS.userId
                            INNER JOIN Companies C ON C.id = U.companyId
                          SET numberCountryId = C.countryId");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("UPDATE CallForwardSettings SET numberCountryId = NULL");

    }
}
