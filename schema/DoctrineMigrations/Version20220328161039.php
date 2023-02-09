<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328161039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'ALTER TABLE ast_ps_endpoints
            CHANGE direct_media direct_media VARCHAR(25) DEFAULT \'yes\' COMMENT \'[enum:yes|no]\',
            CHANGE direct_media_method direct_media_method VARCHAR(25) DEFAULT \'update\' COMMENT \'[enum:update|invite|reinvite]\',
            CHANGE send_diversion send_diversion VARCHAR(25) DEFAULT \'yes\' COMMENT \'[enum:yes|no]\',
            CHANGE send_pai send_pai VARCHAR(25) DEFAULT \'yes\' COMMENT \'[enum:yes|no]\',
            CHANGE 100rel `100rel` VARCHAR(25) DEFAULT \'no\' NOT NULL COMMENT \'[enum:no|required|yes]\',
            CHANGE trust_id_inbound trust_id_inbound VARCHAR(25) DEFAULT NULL COMMENT \'[enum:no|yes]\',
            CHANGE t38_udptl t38_udptl VARCHAR(25) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no]\',
            CHANGE t38_udptl_ec t38_udptl_ec VARCHAR(25) DEFAULT \'redundancy\' NOT NULL COMMENT \'[enum:none|fec|redundancy]\',
            CHANGE t38_udptl_nat t38_udptl_nat VARCHAR(25) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no]\'
        ');
        $this->addSql(
            'ALTER TABLE ast_queues 
            CHANGE autopause autopause VARCHAR(25) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no|all]\',
            CHANGE ringinuse ringinuse VARCHAR(25) DEFAULT \'no\' NOT NULL COMMENT \'[enum:yes|no]\',
            CHANGE strategy strategy VARCHAR(25) DEFAULT NULL COMMENT \'[enum:ringall|leastrecent|fewestcalls|random|rrmemory|linear|wrandom|rrordered]\'
        ');
        $this->addSql(
            'ALTER TABLE ast_voicemail 
            CHANGE attach attach VARCHAR(25) DEFAULT NULL COMMENT \'[enum:yes|no]\',
            CHANGE deleteast_voicemail deleteast_voicemail VARCHAR(25) DEFAULT NULL COMMENT \'[enum:yes|no]\',
            CHANGE sendast_voicemail sendast_voicemail VARCHAR(25) DEFAULT NULL COMMENT \'[enum:yes|no]\',
            CHANGE review review VARCHAR(25) DEFAULT NULL COMMENT \'[enum:yes|no]\',
            CHANGE tempgreetwarn tempgreetwarn VARCHAR(25) DEFAULT NULL COMMENT \'[enum:yes|no]\',
            CHANGE operator operator VARCHAR(25) DEFAULT NULL COMMENT \'[enum:yes|no]\',
            CHANGE envelope envelope VARCHAR(25) DEFAULT NULL COMMENT \'[enum:yes|no]\',
            CHANGE forcename forcename VARCHAR(25) DEFAULT NULL COMMENT \'[enum:yes|no]\',
            CHANGE forcegreetings forcegreetings VARCHAR(25) DEFAULT NULL COMMENT \'[enum:yes|no]\'
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
