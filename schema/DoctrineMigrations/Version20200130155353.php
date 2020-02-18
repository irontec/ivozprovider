<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200130155353 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Update companies by brand
        $this->addSql(
            'UPDATE Companies C INNER JOIN Brands B ON C.brandId = B.id SET C.defaultTimezoneId = B.defaultTimezoneId where C.defaultTimezoneId IS NULL'
        );

        // Update users by company
        $this->addSql(
        'UPDATE Users U INNER JOIN Companies C ON U.companyId = C.id SET U.timezoneId = C.defaultTimezoneId where timezoneId IS NULL'
        );

        // Update company administrators with company timezone
        $this->addSql(
            'UPDATE Administrators A INNER JOIN Companies C ON A.companyId = C.id SET A.timezoneId = C.defaultTimezoneId WHERE A.companyId IS NOT NULL AND A.timezoneId IS NULL'
        );

        // Update brand administrators with brand timezone
        $this->addSql(
            'UPDATE Administrators A INNER JOIN Brands B ON A.brandId = B.id SET A.timezoneId = B.defaultTimezoneId  WHERE A.brandId IS NOT NULL AND A.companyId IS NULL AND A.timezoneId IS NULL'
        );

        // Europe/Madrid for global admins without timezone
        $this->addSql(
            'UPDATE Administrators SET timezoneId = (SELECT id FROM Timezones WHERE tz = \'Europe/Madrid\') where timezoneId IS NULL'
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
