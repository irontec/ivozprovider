<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191008113235 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("UPDATE IVREntries SET numberCountryId =  
                         (SELECT countryId FROM Companies C INNER JOIN IVRs I 
                              ON C.id = I.companyId WHERE I.id = ivrId)
                       WHERE numberValue IS NOT NULL");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
