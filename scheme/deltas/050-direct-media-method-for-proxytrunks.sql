UPDATE `ProxyTrunks` SET direct_media_method='invite';
UPDATE `ast_ps_endpoints` SET direct_media_method='invite' WHERE sorcery_id = 'proxytrunks';
UPDATE ast_ps_endpoints SET send_pai='no' WHERE sorcery_id = 'proxytrunks';
