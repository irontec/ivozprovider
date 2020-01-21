@brand
@calleeIn
@transformationRulesCalleeIn
@brand05
@brand05-2

Feature: Callee in admin page
  As a main operator
  I want to be able to access callee in admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "TransformationRuleSets" CTA
   Then I am on "TransformationRuleSets" list
   When I click on "TransformationRuleSets" first elements "transformationRulesCalleeIn" button
   Then I am on "TransformationRuleSetsList_transformationRulesCalleeIn" subscreen list

Scenario: I can create new callee in
  When I click on add button
   And I fill out the form with "brand/calleeIn/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "TransformationRuleSetsList_transformationRulesCalleeIn" subscreen list
#  When I click on "transformationRules" last elements edit button
#  Then I compare the form data with "brand/calleeIn/new" data fixture

Scenario: I edit save callee in
  Given I can see at least one row
    And I click on "transformationRules" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
  Given I click on close dialog button
   Then I am on "TransformationRuleSetsList_transformationRulesCalleeIn" subscreen list

Scenario: I can click on delete callee in button
  Given I can see at least one row
   When I click on "transformationRules" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRuleSetsList_transformationRulesCalleeIn" subscreen list
