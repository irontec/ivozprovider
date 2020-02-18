<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20191127124853 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

        // Change current 4 priority to 5
        $this->addSql('UPDATE TransformationRules TR
                            INNER JOIN TransformationRuleSets TRS ON TRS.id = TR.transformationRuleSetId
                            SET priority = 5
                            WHERE TRS.brandId IS NULL
                                AND TR.type LIKE "%in"
                                AND TR.priority = 4');

        // Insert new priority 4
        $this->addSql("INSERT INTO TransformationRules (
                                type,
                                description,
                                priority,
                                matchExpr,
                                replaceExpr,
                                transformationRuleSetId
                            ) SELECT
                                'callerin',
                                'From national in e164 without plus to e164',
                                4,
                                CONCAT('^', SUBSTR(C.countryCode,2), '([0-9]+)$'),
                                CONCAT(C.countryCode, '\\\\1'),
                                TRS.id
                                FROM TransformationRuleSets TRS
                                INNER JOIN Countries C ON C.id = TRS.countryId
                                    WHERE brandId IS NULL"
        );

        $this->addSql("INSERT INTO TransformationRules (
                                type,
                                description,
                                priority,
                                matchExpr,
                                replaceExpr,
                                transformationRuleSetId
                            ) SELECT
                                'calleein',
                                'From national in e164 without plus to e164',
                                4,
                                CONCAT('^', SUBSTR(C.countryCode,2), '([0-9]+)$'),
                                CONCAT(C.countryCode, '\\\\1'),
                                TRS.id
                                FROM TransformationRuleSets TRS
                                INNER JOIN Countries C ON C.id = TRS.countryId
                                    WHERE brandId IS NULL"
        );

        // Fix descriptions
        $this->addSql("UPDATE TransformationRules SET description='From national to e164' WHERE description='From special national to e164'");
        $this->addSql("UPDATE TransformationRules SET description='From e164 to national' WHERE description='From e164 to special national'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE TR
                            FROM TransformationRules TR
                            INNER JOIN TransformationRuleSets TRS ON TRS.id = TR.transformationRuleSetId
                            WHERE TRS.brandId IS NULL
                                AND TR.type LIKE "%in"
                                AND TR.priority = 4');
        $this->addSql('UPDATE TransformationRules TR
                            INNER JOIN TransformationRuleSets TRS ON TRS.id = TR.transformationRuleSetId
                            SET priority = 4
                            WHERE TRS.brandId IS NULL
                                AND TR.type LIKE "%in"
                                AND TR.priority = 5');

        $this->addSql("UPDATE TransformationRules SET description='From special national to e164' WHERE description='From national to e164'");
        $this->addSql("UPDATE TransformationRules SET description='From e164 to special national' WHERE description='From e164 to national'");
    }
}
