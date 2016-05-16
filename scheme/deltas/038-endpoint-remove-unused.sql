ALTER TABLE `ast_ps_endpoints` MODIFY `send_diversion` enum('yes','no') DEFAULT 'yes';
ALTER TABLE `ast_ps_endpoints` MODIFY `send_pai` enum('yes','no') DEFAULT 'yes';
ALTER TABLE `ast_ps_endpoints` DROP `send_rpid`;
