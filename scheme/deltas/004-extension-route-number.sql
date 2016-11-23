--
-- Add new route type to extension to call external numbers
--

ALTER TABLE `Extensions` ADD `numberValue` varchar(25) DEFAULT NULL;
ALTER TABLE `Extensions` MODIFY `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom]';

