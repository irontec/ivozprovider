<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190225163038 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // Add E.164 transformations
        $this->addSql('INSERT INTO TransformationRuleSets (
                                name_en,
                                name_es,
                                description
                            ) VALUES (
                                "E.164 (w/o plus)",
                                "E.164 (sin +)",
                                "E.164 without plus notation")'
        );

        $this->addSql('INSERT INTO TransformationRules (
                                type,
                                description,
                                priority,
                                matchExpr,
                                replaceExpr,
                                transformationRuleSetId
                            ) VALUES (
                                "callerin",
                                "From e164 without plus to e164 with plus",
                                1,
                                "^([0-9]+)$",
                                "+\\\\1",
                                (SELECT id FROM TransformationRuleSets WHERE name_en = "E.164 (w/o plus)")
                            ), (
                                "calleein",
                                "From e164 without plus to e164 with plus",
                                1,
                                "^([0-9]+)$",
                                "+\\\\1",
                                (SELECT id FROM TransformationRuleSets WHERE name_en = "E.164 (w/o plus)")
                            ), (
                                "callerout",
                                "From e164 with plus to e164 without plus",
                                1,
                                "^(\\\\+)([0-9]+)$",
                                "\\\\2",
                                (SELECT id FROM TransformationRuleSets WHERE name_en = "E.164 (w/o plus)")
                            ), (
                                "calleeout",
                                "From e164 with plus to e164 without plus",
                                1,
                                "^(\\\\+)([0-9]+)$",
                                "\\\\2",
                                (SELECT id FROM TransformationRuleSets WHERE name_en = "E.164 (w/o plus)")
                            )'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM TransformationRuleSets WHERE name_en = "E.164 (w/o plus)"');
    }
}
