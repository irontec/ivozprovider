DROP TABLE IF EXISTS `kam_users_usr_preferences`;
DROP TABLE IF EXISTS `kam_trunks_usr_preferences`;
DELETE FROM `version` WHERE table_name='kam_users_usr_preferences';
DELETE FROM `version` WHERE table_name='kam_trunks_usr_preferences';
