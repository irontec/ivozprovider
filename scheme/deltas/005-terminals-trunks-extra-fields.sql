ALTER TABLE ProxyTrunks ADD `disallow` varchar(200) NOT NULL DEFAULT 'all';
ALTER TABLE ProxyTrunks ADD `allow` varchar(200) NOT NULL DEFAULT 'all';
ALTER TABLE ProxyTrunks ADD `direct_media` enum('yes','no') NOT NULL DEFAULT 'yes';
ALTER TABLE ProxyTrunks ADD `direct_media_method` enum('invite','reinvite','update') NOT NULL DEFAULT 'update' COMMENT '[enum:update|invite|reinvite]';

ALTER TABLE Terminals ADD `disallow` varchar(200) NOT NULL DEFAULT 'all' AFTER `name`;
ALTER TABLE Terminals ADD `direct_media_method` enum('invite','reinvite','update') NOT NULL DEFAULT 'update' COMMENT '[enum:update|invite|reinvite]' AFTER `direct_media`;
ALTER TABLE Terminals ADD `dtmf_mode` enum('rfc4733','inband','info') NOT NULL DEFAULT 'rfc4733' AFTER `direct_media_method`;


ALTER TABLE ast_ps_endpoints MODIFY `dtmf_mode` enum('rfc4733','inband','info') NOT NULL DEFAULT 'rfc4733';
