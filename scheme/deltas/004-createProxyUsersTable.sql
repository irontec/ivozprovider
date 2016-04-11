CREATE TABLE `proxyUsers` (
  `id` binary(36) NOT NULL COMMENT '[uuid:php]',
  `name` varchar(100) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

