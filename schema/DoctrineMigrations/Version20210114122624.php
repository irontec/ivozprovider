<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20210114122624 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

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

        $this->addSql(
        "UPDATE `InvoiceTemplates` SET
                  template = $basicBody,
                  templateHeader = $header,
                  templateFooter = $footer
             WHERE `name` = 'Basic'"
        );

        $this->addSql(
            "UPDATE `InvoiceTemplates` SET
                  template = $detailedBody,
                  templateHeader = $header,
                  templateFooter = $footer
             WHERE `name` = 'Detailed'"
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }
}
