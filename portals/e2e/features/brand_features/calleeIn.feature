@brand
@calleeIn
@kamTrunksDialplanCalleeIn

Feature: Callee in admin page
  As a main operator
  I want to be able to access callee in admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "TransformationRulesetGroupsTrunks" CTA
  Then I am on "TransformationRulesetGroupsTrunks" list
  Given I click on "TransformationRulesetGroupsTrunks" first elements "kamTrunksDialplan_callee_in" button
  Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_callee_in" subscreen list

  Scenario: I can save calle in
    Given I can see at least one row
    And I click on "kamTrunksDialplan" first elements edit button
    And I click on save button
    Then I can see save confirmation dialog
    Given I click on close dialog button
    Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_callee_in" subscreen list

  Scenario: I see new calle in admin page
    Given I click on add button
    And I click on close button
    Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_callee_in" subscreen list

  Scenario: I can click on delete calle in button
    Given I can see at least one row
    And I click on "kamTrunksDialplan" first elements delete button
    Then I can see save confirmation dialog
    Given I click on close dialog button
    Then I am on "TransformationRulesetGroupsTrunksList_kamTrunksDialplan_callee_in" subscreen list
