ALTER TABLE `kam_acc_cdrs` ADD `start_time_utc` timestamp DEFAULT '2000-01-01 00:00:00' AFTER `proxy`;
ALTER TABLE `kam_acc_cdrs` CHANGE `calldate` `end_time_utc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;

CREATE TRIGGER start_time_trigger
BEFORE INSERT ON kam_acc_cdrs
FOR EACH ROW
SET new.start_time_utc = FROM_UNIXTIME( UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(new.end_time) + UNIX_TIMESTAMP(new.start_time) );
