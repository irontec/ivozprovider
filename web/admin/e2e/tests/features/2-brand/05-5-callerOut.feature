@brand
@callerOut
@transformationRulesCallerOut
@brand05
@brand05-5

Feature: Caller out admin page
  As a main operator
  I want to be able to access caller out admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "TransformationRuleSets" CTA
   Then I am on "TransformationRuleSets" list
   When I click on "TransformationRuleSets" first elements "transformationRulesCallerOut" button
   Then I am on "TransformationRuleSetsList_transformationRulesCallerOut" subscreen list

Scenario: I can create new caller out
  When I click on add button
   And I fill out the form with "brand/callerOut/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "TransformationRuleSetsList_transformationRulesCallerOut" subscreen list
#  When I click on "transformationRules" last elements edit button
#  Then I compare the form data with "brand/callerOut/new" data fixture

Scenario: I can save caller out
  Given I can see at least one row
   When I click on "transformationRules" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRuleSetsList_transformationRulesCallerOut" subscreen list

Scenario: I can click on delete caller out button
  Given I can see at least one row
   When I click on "transformationRules" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRuleSetsList_transformationRulesCallerOut" subscreen list
