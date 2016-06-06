DELETE FROM ast_ps_endpoints WHERE sorcery_id = 'proxytrunks';
ALTER TABLE ast_ps_endpoints DROP FOREIGN KEY `ast_ps_endpoints_ibfk_2`;
ALTER TABLE ast_ps_endpoints DROP proxyTrunkId;
ALTER TABLE ast_ps_endpoints DROP trust_id_inbound;
ALTER TABLE ast_ps_endpoints DROP t38_udptl;

ALTER TABLE ProxyTrunks DROP direct_media_method;
ALTER TABLE ProxyTrunks DROP direct_media;
ALTER TABLE ProxyTrunks DROP allow;
ALTER TABLE ProxyTrunks DROP disallow;

