@brand
@pricingPlansRelTargetPatterns

Feature: Pricing plans - Target patterns admin page
  As a main operator
  I want to be able to access pricing plans admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "PricingPlans" CTA
  Then I am on "PricingPlans" list
  Given I click on "PricingPlans" first elements "pricingPlansRelTargetPatterns" button
  Then I am on "PricingPlansList_pricingPlansRelTargetPatterns" subscreen list

Scenario: I can save pricing plans - target patterns
  Given I can see at least one row
  And I click on "pricingPlansRelTargetPatterns" first elements edit button
  And I click on save button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "PricingPlansList_pricingPlansRelTargetPatterns" subscreen list

Scenario: I see new pricing plan - target pattern admin page
  Given I click on add button
  And I click on close button
  Then I am on "PricingPlansList_pricingPlansRelTargetPatterns" subscreen list

Scenario: I can click on delete pricing plan - target pattern button
  Given I can see at least one row
  And I click on "pricingPlansRelTargetPatterns" first elements delete button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "PricingPlansList_pricingPlansRelTargetPatterns" subscreen list
