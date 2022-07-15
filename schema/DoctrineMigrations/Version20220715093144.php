<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715093144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fix Congo name duplication';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            "update Countries set
            name_en = CONCAT(name_en, ' Brazaville'),
            name_es = CONCAT(name_es, ' Brazaville'),
            name_ca = CONCAT(name_ca, ' Brazaville'),
            name_it = CONCAT(name_it, ' Brazaville')
            WHERE code = 'CG'
            limit 1"
        );

        $this->addSql(
            "update TransformationRuleSets set
            name_en = CONCAT(name_en, ' Brazaville'),
            name_es = CONCAT(name_es, ' Brazaville'),
            name_ca = CONCAT(name_ca, ' Brazaville'),
            name_it = CONCAT(name_it, ' Brazaville')
            WHERE countryId = (select id from Countries where code = 'CG')"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
