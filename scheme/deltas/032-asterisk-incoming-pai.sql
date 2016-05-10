ALTER TABLE ast_ps_endpoints ADD `trust_id_inbound` enum('yes','no') DEFAULT NULL;
UPDATE ast_ps_endpoints SET trust_id_inbound = 'yes' WHERE sorcery_id = 'proxytrunks';
