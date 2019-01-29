<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190121183004 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("UPDATE TransformationRuleSets SET internationalCode = '810', nationalLen = 10 WHERE id = 193");
        $this->addSql("UPDATE TransformationRules SET matchExpr = '^\\\\+7([0-9]{10})$' WHERE id = 74 OR id = 711");
        $this->addSql("UPDATE TransformationRules SET matchExpr = '^(\\\\+|810)([0-9]+)$' WHERE id = 1465 OR id = 2102");
        $this->addSql("UPDATE TransformationRules SET matchExpr = '^8([0-9]{10})$' WHERE id = 1603 OR id = 2240");
        $this->addSql("UPDATE TransformationRules SET replaceExpr = '810\\\\1' WHERE id = 573 OR id = 1210");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("UPDATE TransformationRuleSets SET internationalCode = '00', nationalLen = 9 WHERE id = 193");
        $this->addSql("UPDATE TransformationRules SET matchExpr = '^\\\\+7([0-9]{9})$' WHERE id = 74 OR id = 711");
        $this->addSql("UPDATE TransformationRules SET matchExpr = '^(\\\\+|00)([0-9]+)$' WHERE id = 1465 OR id = 2102");
        $this->addSql("UPDATE TransformationRules SET matchExpr = '^8([0-9]{9})$' WHERE id = 1603 OR id = 2240");
        $this->addSql("UPDATE TransformationRules SET replaceExpr = '00\\\\1' WHERE id = 573 OR id = 1210");
    }
}
