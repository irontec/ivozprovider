@brand
@callerIn
@kamTrunksDialplanCallerIn
@brand05
@brand05-3

Feature: Caller in admin page
  As a main operator
  I want to be able to access caller in admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "TransformationRulesetGroupsTrunks" CTA
   Then I am on "TransformationRulesetGroupsTrunks" list
   When I click on "TransformationRulesetGroupsTrunks" first elements "kamTrunksDialplan_caller_in" button
   Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_caller_in" subscreen list

Scenario: I can create new caller in
  When I click on add button
   And I fill out the form with "brand/callerIn/new" data fixture
  When I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_caller_in" subscreen list

Scenario: I can save caller in
  Given I can see at least one row
   When I click on "kamTrunksDialplan" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_caller_in" subscreen list

Scenario: I can click on delete caller in button
  Given I can see at least one row
   When I click on "kamTrunksDialplan" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_caller_in" subscreen list
