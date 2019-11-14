<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191114115328 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("UPDATE InvoiceTemplates SET templateHeader = REPLACE(templateHeader, 'brand.postalCode', 'brand.invoice.postalCode')");
        $this->addSql("UPDATE InvoiceTemplates SET templateHeader = REPLACE(templateHeader, 'brand.town', 'brand.invoice.town')");
        $this->addSql("UPDATE InvoiceTemplates SET templateHeader = REPLACE(templateHeader, 'brand.province', 'brand.invoice.province')");
        $this->addSql("UPDATE InvoiceTemplates SET templateHeader = REPLACE(templateHeader, 'brand.postalAddress', 'brand.invoice.postalAddress')");
        $this->addSql("UPDATE InvoiceTemplates SET templateHeader = REPLACE(templateHeader, 'brand.nif', 'brand.invoice.nif')");
        $this->addSql("UPDATE InvoiceTemplates SET templateFooter = REPLACE(templateFooter, 'brand.registryData', 'brand.invoice.registryData')");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
