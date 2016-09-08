ALTER TABLE `kam_acc_cdrs` ADD `targetPatternName` varchar(55) DEFAULT NULL AFTER `targetPatternId`;
ALTER TABLE `kam_acc_cdrs` ADD `pricingPlanName` varchar(55) DEFAULT NULL AFTER `pricingPlanId`;
UPDATE kam_acc_cdrs SET pricingPlanName = (SELECT name_es FROM PricingPlans where id = pricingPlanId) where pricingPlanId is NOT NULL;
UPDATE kam_acc_cdrs SET targetPatternName = (SELECT name_es FROM TargetPatterns where id = targetPatternId) where targetPatternId is NOT NULL;
