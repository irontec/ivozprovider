-- Asterisk no longer handles endpoint subscriptions
ALTER TABLE `ast_ps_endpoints` DROP `subscribecontext`;
