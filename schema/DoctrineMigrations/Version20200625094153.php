<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200625094153 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // Remove E.164 without plus -> E.164 with plus incoming transformation in all
        // countries but Spain (for customer retro-compatibility)
        $this->addSql("DELETE FROM TransformationRules
                        WHERE description = 'From national in e164 without plus to e164'
                          AND transformationRuleSetId <= 253
                          AND transformationRuleSetId != 70");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // This migration can not be undone

    }
}
