ALTER TABLE `proxyTrunks` ADD `ip` varchar(100) NOT NULL;
ALTER TABLE `proxyTrunks` ADD UNIQUE KEY `ip` (`ip`);
