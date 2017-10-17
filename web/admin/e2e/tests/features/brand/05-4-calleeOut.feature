@brand
@calleeOut
@kamTrunksDialplanCalleeOut
@05-4

Feature: Callee out admin page
  As a main operator
  I want to be able to access callee out admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "TransformationRulesetGroupsTrunks" CTA
   Then I am on "TransformationRulesetGroupsTrunks" list
   When I click on "TransformationRulesetGroupsTrunks" first elements "kamTrunksDialplan_callee_out" button
   Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_callee_out" subscreen list

Scenario: I can create new callee out
  When I click on add button
   And I fill out the form with "brand/calleeOut/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_callee_out" subscreen list

Scenario: I can edit callee out
  Given I can see at least one row
   When I click on "kamTrunksDialplan" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_callee_out" subscreen list

Scenario: I can click on delete callee out button
  Given I can see at least one row
   When I click on "kamTrunksDialplan" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_callee_out" subscreen list
