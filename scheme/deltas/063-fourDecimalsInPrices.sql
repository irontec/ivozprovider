ALTER TABLE PricingPlansRelTargetPatterns MODIFY perPeriodCharge DECIMAL(10,4) NOT NULL;
ALTER TABLE PricingPlansRelTargetPatterns MODIFY connectionCharge DECIMAL(10,4) NOT NULL;
ALTER TABLE FixedCosts MODIFY cost DECIMAL(10,4);