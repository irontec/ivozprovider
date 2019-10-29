<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191025092721 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE InvoiceTemplates CHANGE brandId brandId INT UNSIGNED DEFAULT NULL');

        $header = $this->connection->quote(
            file_get_contents(
                '/opt/irontec/ivozprovider/web/admin/templates/header.txt'
            )
        );
        $footer = $this->connection->quote(
            file_get_contents(
                '/opt/irontec/ivozprovider/web/admin/templates/footer.txt'
            )
        );
        $basicBody = $this->connection->quote(
            file_get_contents(
                '/opt/irontec/ivozprovider/web/admin/templates/basic.txt'
            )
        );
        $detailedBody = $this->connection->quote(
            file_get_contents(
                '/opt/irontec/ivozprovider/web/admin/templates/detailed.txt'
            )
        );


        $this->addSql("INSERT INTO `InvoiceTemplates` (
                              name,
                              description,
                              template,
                              templateHeader,
                              templateFooter
                          ) VALUES (
                              'Basic',
                              'Basic invoice template',
                              $basicBody,
                              $header,
                              $footer
                          )");

        $this->addSql("INSERT INTO `InvoiceTemplates` (
                              name,
                              description,
                              template,
                              templateHeader,
                              templateFooter
                          ) VALUES (
                              'Detailed',
                              'Detailed invoice template',
                              $detailedBody,
                              $header,
                              $footer
                          )");



    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM InvoiceTemplates WHERE brandId IS NULL');
        $this->addSql('ALTER TABLE InvoiceTemplates CHANGE brandId brandId INT UNSIGNED NOT NULL');
    }
}
