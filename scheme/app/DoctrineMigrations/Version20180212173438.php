<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180212173438 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('ALTER TABLE Commandlog RENAME INDEX requestid TO commandlog_requestId');
        $this->addSql('ALTER TABLE ast_ps_endpoints RENAME INDEX terminalid TO psEndpoint_terminalId');
        $this->addSql('ALTER TABLE ast_ps_endpoints RENAME INDEX friendid TO psEndpoint_friendId');
        $this->addSql('ALTER TABLE ast_ps_endpoints RENAME INDEX sorcery_idx TO psEndpoint_sorcery_idx');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX ast_voicemail_mailbox TO voicemail_mailbox');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX ast_voicemail_context TO voicemail__context');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX ast_voicemail_mailbox_context TO voicemail_mailbox_context');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX ast_voicemail_imapuser TO voicemail_imapuser');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX userid TO voicemail_userId');
        $this->addSql('ALTER TABLE ast_queues RENAME INDEX queueid TO queue_queueId');
        $this->addSql('ALTER TABLE kam_users_location RENAME INDEX account_contact_idx TO usersLocation_account_contact_idx');
        $this->addSql('ALTER TABLE kam_users_location RENAME INDEX expires_idx TO usersLocation_expires_idx');
        $this->addSql('ALTER TABLE kam_rtpproxy RENAME INDEX mediarelaysetsid TO rtpproxy_mediaRelaySetsId');
        $this->addSql('ALTER TABLE kam_users_location_attrs RENAME INDEX account_record_idx TO usersLocationAttr_account_record_idx');
        $this->addSql('ALTER TABLE kam_users_location_attrs RENAME INDEX last_modified_idx TO usersLocationAttr_last_modified_idx');
        $this->addSql('ALTER TABLE kam_trunks_uacreg RENAME INDEX peeringcontractid TO trunksUacreg_peeringContractId');
        $this->addSql('ALTER TABLE kam_users_missed_calls RENAME INDEX callid_idx TO usersMissedCall_callid_idx');
        $this->addSql('ALTER TABLE kam_users_pua RENAME INDEX expires_idx TO usersPua_expires_idx');
        $this->addSql('ALTER TABLE kam_users_pua RENAME INDEX dialog1_idx TO usersPua_dialog1_idx');
        $this->addSql('ALTER TABLE kam_users_pua RENAME INDEX dialog2_idx TO usersPua_dialog2_idx');
        $this->addSql('ALTER TABLE kam_users_pua RENAME INDEX record_idx TO usersPua_record_idx');
        $this->addSql('ALTER TABLE kam_users_presentity RENAME INDEX kam_users_presentity_expires TO usersPresentity_expires');
        $this->addSql('ALTER TABLE kam_users_presentity RENAME INDEX account_idx TO usersPresentity_account_idx');
        $this->addSql('ALTER TABLE kam_users_xcap RENAME INDEX account_doc_type_idx TO UsersXcap_account_doc_type_idx');
        $this->addSql('ALTER TABLE kam_users_xcap RENAME INDEX account_doc_type_uri_idx TO UsersXcap_account_doc_type_uri_idx');
        $this->addSql('ALTER TABLE kam_users_xcap RENAME INDEX account_doc_uri_idx TO UsersXcap_account_doc_uri_idx');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX start_time_idx TO usersCdr_start_time_idx');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX end_time_idx TO usersCdr_end_time_idx');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX callid_idx TO usersCdr_callid_idx');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX xcallid_idx TO usersCdr_xcallid_idx');
        $this->addSql('ALTER TABLE kam_dispatcher RENAME INDEX applicationserverid TO dispatcher_applicationServerId');
        $this->addSql('ALTER TABLE kam_users_active_watchers RENAME INDEX kam_users_active_watchers_expires TO usersActiveWatcher_expires');
        $this->addSql('ALTER TABLE kam_users_active_watchers RENAME INDEX kam_users_active_watchers_pres TO usersActiveWatcher_pres');
        $this->addSql('ALTER TABLE kam_users_active_watchers RENAME INDEX updated_idx TO usersActiveWatcher_updated_idx');
        $this->addSql('ALTER TABLE kam_users_active_watchers RENAME INDEX updated_winfo_idx TO usersActiveWatcher_updated_winfo_idx');
        $this->addSql('ALTER TABLE tp_rates RENAME INDEX tpid TO tpRate_tpid');
        $this->addSql('ALTER TABLE tp_rates RENAME INDEX tpid_rtid TO tpRate_tpid_rtid');
        $this->addSql('ALTER TABLE tp_account_actions RENAME INDEX tpid TO tpAccountAction_tpid');
        $this->addSql('ALTER TABLE DestinationRates RENAME INDEX brandid TO destinationRate_brandId');
        $this->addSql('ALTER TABLE DestinationRates RENAME INDEX brandtag TO destinationRate_brandTag');
        $this->addSql('ALTER TABLE tp_rating_profiles RENAME INDEX tpid TO tpRatingProfile_tpid');
        $this->addSql('ALTER TABLE tp_rating_profiles RENAME INDEX tpid_loadid TO tpRatingProfile_tpid_loadid');
        $this->addSql('ALTER TABLE Rates RENAME INDEX brandid TO rate_brandId');
        $this->addSql('ALTER TABLE Rates RENAME INDEX brandtag TO rate_brandTag');
        $this->addSql('ALTER TABLE Destinations RENAME INDEX brandid TO destination_brandId');
        $this->addSql('ALTER TABLE Destinations RENAME INDEX brandtag TO destination_brandTag');
        $this->addSql('ALTER TABLE tp_destination_rates RENAME INDEX tpid TO tpDestinationRate_tpid');
        $this->addSql('ALTER TABLE tp_destination_rates RENAME INDEX tpid_drid TO tpDestinationRate_tpid_drid');
        $this->addSql('ALTER TABLE tp_rating_plans RENAME INDEX tpid TO tpRatingPlan_tpid');
        $this->addSql('ALTER TABLE tp_rating_plans RENAME INDEX tpid_rpl TO tpRatingPlan_tpid_rpl');
        $this->addSql('ALTER TABLE tp_timings RENAME INDEX tpid TO tpTiming_tpid');
        $this->addSql('ALTER TABLE tp_destinations RENAME INDEX tpid TO tpDestination_tpid');
        $this->addSql('ALTER TABLE tp_destinations RENAME INDEX tpid_dstid TO tpDestination_tpid_dstid');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Commandlog RENAME INDEX commandlog_requestid TO requestId');
        $this->addSql('ALTER TABLE DestinationRates RENAME INDEX destinationrate_brandtag TO brandTag');
        $this->addSql('ALTER TABLE DestinationRates RENAME INDEX destinationrate_brandid TO brandId');
        $this->addSql('ALTER TABLE Destinations RENAME INDEX destination_brandtag TO brandTag');
        $this->addSql('ALTER TABLE Destinations RENAME INDEX destination_brandid TO brandId');
        $this->addSql('ALTER TABLE Rates RENAME INDEX rate_brandtag TO brandTag');
        $this->addSql('ALTER TABLE Rates RENAME INDEX rate_brandid TO brandId');
        $this->addSql('ALTER TABLE ast_ps_endpoints RENAME INDEX psendpoint_terminalid TO terminalId');
        $this->addSql('ALTER TABLE ast_ps_endpoints RENAME INDEX psendpoint_friendid TO friendId');
        $this->addSql('ALTER TABLE ast_ps_endpoints RENAME INDEX psendpoint_sorcery_idx TO sorcery_idx');
        $this->addSql('ALTER TABLE ast_queues RENAME INDEX queue_queueid TO queueId');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX voicemail_mailbox TO ast_voicemail_mailbox');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX voicemail__context TO ast_voicemail_context');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX voicemail_mailbox_context TO ast_voicemail_mailbox_context');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX voicemail_imapuser TO ast_voicemail_imapuser');
        $this->addSql('ALTER TABLE ast_voicemail RENAME INDEX voicemail_userid TO userId');
        $this->addSql('ALTER TABLE kam_dispatcher RENAME INDEX dispatcher_applicationserverid TO applicationServerId');
        $this->addSql('ALTER TABLE kam_rtpproxy RENAME INDEX rtpproxy_mediarelaysetsid TO mediaRelaySetsId');
        $this->addSql('ALTER TABLE kam_trunks_uacreg RENAME INDEX trunksuacreg_peeringcontractid TO peeringContractId');
        $this->addSql('ALTER TABLE kam_users_active_watchers RENAME INDEX usersactivewatcher_expires TO kam_users_active_watchers_expires');
        $this->addSql('ALTER TABLE kam_users_active_watchers RENAME INDEX usersactivewatcher_pres TO kam_users_active_watchers_pres');
        $this->addSql('ALTER TABLE kam_users_active_watchers RENAME INDEX usersactivewatcher_updated_idx TO updated_idx');
        $this->addSql('ALTER TABLE kam_users_active_watchers RENAME INDEX usersactivewatcher_updated_winfo_idx TO updated_winfo_idx');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX userscdr_start_time_idx TO start_time_idx');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX userscdr_end_time_idx TO end_time_idx');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX userscdr_callid_idx TO callid_idx');
        $this->addSql('ALTER TABLE kam_users_cdrs RENAME INDEX userscdr_xcallid_idx TO xcallid_idx');
        $this->addSql('ALTER TABLE kam_users_location RENAME INDEX userslocation_account_contact_idx TO account_contact_idx');
        $this->addSql('ALTER TABLE kam_users_location RENAME INDEX userslocation_expires_idx TO expires_idx');
        $this->addSql('ALTER TABLE kam_users_location_attrs RENAME INDEX userslocationattr_account_record_idx TO account_record_idx');
        $this->addSql('ALTER TABLE kam_users_location_attrs RENAME INDEX userslocationattr_last_modified_idx TO last_modified_idx');
        $this->addSql('ALTER TABLE kam_users_missed_calls RENAME INDEX usersmissedcall_callid_idx TO callid_idx');
        $this->addSql('ALTER TABLE kam_users_presentity RENAME INDEX userspresentity_expires TO kam_users_presentity_expires');
        $this->addSql('ALTER TABLE kam_users_presentity RENAME INDEX userspresentity_account_idx TO account_idx');
        $this->addSql('ALTER TABLE kam_users_pua RENAME INDEX userspua_expires_idx TO expires_idx');
        $this->addSql('ALTER TABLE kam_users_pua RENAME INDEX userspua_dialog1_idx TO dialog1_idx');
        $this->addSql('ALTER TABLE kam_users_pua RENAME INDEX userspua_dialog2_idx TO dialog2_idx');
        $this->addSql('ALTER TABLE kam_users_pua RENAME INDEX userspua_record_idx TO record_idx');
        $this->addSql('ALTER TABLE kam_users_xcap RENAME INDEX usersxcap_account_doc_type_idx TO account_doc_type_idx');
        $this->addSql('ALTER TABLE kam_users_xcap RENAME INDEX usersxcap_account_doc_type_uri_idx TO account_doc_type_uri_idx');
        $this->addSql('ALTER TABLE kam_users_xcap RENAME INDEX usersxcap_account_doc_uri_idx TO account_doc_uri_idx');
        $this->addSql('ALTER TABLE tp_account_actions RENAME INDEX tpaccountaction_tpid TO tpid');
        $this->addSql('ALTER TABLE tp_destination_rates RENAME INDEX tpdestinationrate_tpid TO tpid');
        $this->addSql('ALTER TABLE tp_destination_rates RENAME INDEX tpdestinationrate_tpid_drid TO tpid_drid');
        $this->addSql('ALTER TABLE tp_destinations RENAME INDEX tpdestination_tpid TO tpid');
        $this->addSql('ALTER TABLE tp_destinations RENAME INDEX tpdestination_tpid_dstid TO tpid_dstid');
        $this->addSql('ALTER TABLE tp_rates RENAME INDEX tprate_tpid TO tpid');
        $this->addSql('ALTER TABLE tp_rates RENAME INDEX tprate_tpid_rtid TO tpid_rtid');
        $this->addSql('ALTER TABLE tp_rating_plans RENAME INDEX tpratingplan_tpid TO tpid');
        $this->addSql('ALTER TABLE tp_rating_plans RENAME INDEX tpratingplan_tpid_rpl TO tpid_rpl');
        $this->addSql('ALTER TABLE tp_rating_profiles RENAME INDEX tpratingprofile_tpid TO tpid');
        $this->addSql('ALTER TABLE tp_rating_profiles RENAME INDEX tpratingprofile_tpid_loadid TO tpid_loadid');
        $this->addSql('ALTER TABLE tp_timings RENAME INDEX tptiming_tpid TO tpid');
    }
}
