<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180717102522 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Each service can only be once!
        $this->addSql('CREATE UNIQUE INDEX brandService_brand_service ON BrandServices (brandId, serviceId)');
        $this->addSql('CREATE UNIQUE INDEX companyService_company_service ON CompanyServices (companyId, serviceId)');

        // Create Services codes for default brand and Company if no service code has been created yet
        $this->addSql('INSERT IGNORE INTO BrandServices (serviceId, brandId, code) SELECT id, 1, defaultCode FROM Services WHERE iden IN (\'CloseLock\', \'OpenLock\', \'ToggleLock\')');
        $this->addSql('INSERT IGNORE INTO CompanyServices (serviceId, companyId, code) SELECT id, 1, defaultCode FROM Services WHERE iden IN (\'CloseLock\', \'OpenLock\', \'ToggleLock\')');


    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX brandService_brand_service ON BrandServices');
        $this->addSql('DROP INDEX companyService_company_service ON CompanyServices');
    }
}
