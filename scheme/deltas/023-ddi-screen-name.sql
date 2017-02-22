/**
 * Display name will be displayed in the final called terminal
 * Displayed extension won't be changed in any way
 */

ALTER TABLE `DDIs` ADD `displayName` varchar(50) DEFAULT NULL AFTER `recordCalls`;

