--
-- International code for each country
-- This will be standarize incoming international e164 numbers to user preferred display for its country
--
-- NOTE: Take into account that some Countries have variable international codes so this table MUST be improved
--       to support carrier international codes for those countries.
--
ALTER TABLE `Countries` ADD `intCode` varchar(5) DEFAULT NULL;
UPDATE `Countries` SET `intCode` = '00';
UPDATE `Countries` SET `intCode` = '011' WHERE code IN ('US', 'CA');
UPDATE `Countries` SET `intCode` = '010' WHERE code IN ('JP');
UPDATE `Countries` SET `intCode` = '0011' WHERE code IN ('AU');

--
-- E164 National number detection
-- This will be used to split country national calls into different components in order to allow shortest
-- possible dial strings if the destination share the same calling code and area code than the originating
-- user.
--
ALTER TABLE `Countries` ADD `e164Pattern` varchar(250)  DEFAULT NULL;
UPDATE `Countries` SET e164Pattern = CONCAT('/^(\\+|', intCode, ')?(?<cc>', calling_code, ')?(?<sn>\\d{9})$/');
UPDATE `Countries` SET e164Pattern = CONCAT('/^(\\+|011)?(?<cc>1)?(?<ac>\\d{3})?(?<sn>\\d{7})$/') WHERE code IN ('US');

--
-- Determine if calls from different areas in this country include calling code
--
ALTER TABLE `Countries` ADD `nationalCC` tinyint(1) NOT NULL DEFAULT '0';
UPDATE `Countries` SET `nationalCC` = '1' WHERE code IN ('US');

--
-- Default Area code for users in this company, see below
--
ALTER TABLE `Companies` ADD `areaCode` varchar(10) DEFAULT NULL;

--
-- User Area code for Countries that have short dial for numbers in the same area
--
ALTER TABLE `Users` ADD `areaCode` varchar(10) DEFAULT NULL;
