ALTER TABLE Extensions MODIFY `routeType` varchar(25) NOT NULL DEFAULT 'user' COMMENT '[enum:user|IVRCommon|IVRCustom|huntGroup]';
ALTER TABLE Users MODIFY `active` tinyint(1) NOT NULL DEFAULT '1';
