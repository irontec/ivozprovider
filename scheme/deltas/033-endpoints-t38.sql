ALTER TABLE ast_ps_endpoints ADD `t38_udptl` enum('yes','no') DEFAULT 'no';
UPDATE ast_ps_endpoints SET t38_udptl='yes' WHERE sorcery_id='proxytrunks';
