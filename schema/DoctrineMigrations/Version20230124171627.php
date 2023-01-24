<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124171627 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'New value none for Companies.billingMethod';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Companies CHANGE billingMethod billingMethod VARCHAR(25) DEFAULT \'postpaid\' NOT NULL COMMENT \'[enum:postpaid|prepaid|pseudoprepaid|none]\'');
        // set billingMethod to none only in clients belonging to brands with every carrier is externally rated (do not touch billingMethod is no carrier exists)
        $this->addSql("UPDATE Companies SET billingMethod = 'none' WHERE brandId IN (SELECT B.id FROM Brands B INNER JOIN Carriers C ON C.brandId = B.id WHERE B.id NOT IN (SELECT brandId FROM Carriers WHERE externallyRated = 0))");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Companies CHANGE billingMethod billingMethod VARCHAR(25) DEFAULT \'postpaid\' NOT NULL COMMENT \'[enum:postpaid|prepaid|pseudoprepaid]\'');
    }
}
