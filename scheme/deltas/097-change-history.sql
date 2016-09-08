CREATE TABLE `ChangeHistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` varchar(15) NOT NULL,
  `table` varchar(50) NOT NULL,
  `objid` int(10) unsigned NOT NULL,
  `field` varchar(50) NOT NULL,
  `old_value` varchar(250),
  `new_value` varchar(250),
  PRIMARY KEY (`id`)
) COMMENT='[entity]';
