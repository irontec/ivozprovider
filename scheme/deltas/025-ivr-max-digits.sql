/* Add max IVR input digits. This can be handy if extensions or entries have
   a fixed length. Zero or NULL is handled as unlimited, the original behaviour */
ALTER TABLE `IVRCommon` ADD `maxDigits` smallint(5) unsigned NOT NULL AFTER `timeout`;
ALTER TABLE `IVRCustom` ADD `maxDigits` smallint(5) unsigned NOT NULL AFTER `timeout`;
