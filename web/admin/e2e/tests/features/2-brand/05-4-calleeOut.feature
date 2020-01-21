@brand
@calleeOut
@transformationRulesCalleeOut
@brand05
@brand05-4

Feature: Callee out admin page
  As a main operator
  I want to be able to access callee out admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "TransformationRuleSets" CTA
   Then I am on "TransformationRuleSets" list
   When I click on "TransformationRuleSets" first elements "transformationRulesCalleeOut" button
   Then I am on "TransformationRuleSetsList_transformationRulesCalleeOut" subscreen list

Scenario: I can create new callee out
  When I click on add button
   And I fill out the form with "brand/calleeOut/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "TransformationRuleSetsList_transformationRulesCalleeOut" subscreen list
#  When I click on "transformationRules" last elements edit button
#  Then I compare the form data with "brand/calleeOut/new" data fixture

Scenario: I can edit callee out
  Given I can see at least one row
   When I click on "transformationRules" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRuleSetsList_transformationRulesCalleeOut" subscreen list

Scenario: I can click on delete callee out button
  Given I can see at least one row
   When I click on "transformationRules" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRuleSetsList_transformationRulesCalleeOut" subscreen list
