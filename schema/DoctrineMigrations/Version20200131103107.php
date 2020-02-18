<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200131103107 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX psEndpoint_id ON ast_ps_endpoints');
        $this->addSql('DROP INDEX voicemail_mailbox ON ast_voicemail');
        $this->addSql('DROP INDEX trunksCdr_callid_idx ON kam_trunks_cdrs');
        $this->addSql('DROP INDEX usersPua_record_idx ON kam_users_pua');
        $this->addSql('DROP INDEX usersPresentity_account_idx ON kam_users_presentity');
        $this->addSql('DROP INDEX UsersXcap_account_doc_type_idx ON kam_users_xcap');
        $this->addSql('DROP INDEX usersCdr_callid_idx ON kam_users_cdrs');
        $this->addSql('DROP INDEX tpRate_tpid_rtid ON tp_rates');
        $this->addSql('DROP INDEX tpAccountAction_tpid ON tp_account_actions');
        $this->addSql('DROP INDEX tpCdr_cgrid_idx ON tp_cdrs');
        $this->addSql('DROP INDEX tpRatingProfile_tpid ON tp_rating_profiles');
        $this->addSql('DROP INDEX tpRatingProfile_tpid_loadid ON tp_rating_profiles');
        $this->addSql('DROP INDEX tpDestinationRate_tpid_drid ON tp_destination_rates');
        $this->addSql('DROP INDEX tpRatingPlan_tpid_rpl ON tp_rating_plans');
        $this->addSql('DROP INDEX tpDestination_tpid_dstid ON tp_destinations');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX psEndpoint_id ON ast_ps_endpoints (id)');
        $this->addSql('CREATE INDEX voicemail_mailbox ON ast_voicemail (mailbox)');
        $this->addSql('CREATE INDEX trunksCdr_callid_idx ON kam_trunks_cdrs (callid)');
        $this->addSql('CREATE INDEX usersCdr_callid_idx ON kam_users_cdrs (callid)');
        $this->addSql('CREATE INDEX usersPresentity_account_idx ON kam_users_presentity (username, domain, event)');
        $this->addSql('CREATE INDEX usersPua_record_idx ON kam_users_pua (pres_id)');
        $this->addSql('CREATE INDEX UsersXcap_account_doc_type_idx ON kam_users_xcap (username, domain, doc_type)');
        $this->addSql('CREATE INDEX tpAccountAction_tpid ON tp_account_actions (tpid)');
        $this->addSql('CREATE INDEX tpCdr_cgrid_idx ON tp_cdrs (cgrid)');
        $this->addSql('CREATE INDEX tpDestinationRate_tpid_drid ON tp_destination_rates (tpid, tag)');
        $this->addSql('CREATE INDEX tpDestination_tpid_dstid ON tp_destinations (tpid, tag)');
        $this->addSql('CREATE INDEX tpRate_tpid_rtid ON tp_rates (tpid, tag)');
        $this->addSql('CREATE INDEX tpRatingPlan_tpid_rpl ON tp_rating_plans (tpid, tag)');
        $this->addSql('CREATE INDEX tpRatingProfile_tpid ON tp_rating_profiles (tpid)');
        $this->addSql('CREATE INDEX tpRatingProfile_tpid_loadid ON tp_rating_profiles (tpid, loadid)');
    }
}
