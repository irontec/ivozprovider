@company
@callForwardSettings
@company03
@company03-2

Feature: Users admin page
  As a main operator
  I want to be able to access call forward settings admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "Users" CTA
   Then I am on "Users" list
   When I click on "Users" first elements "callForwardSettings" button
   Then I am on "UsersList_callForwardSettings" subscreen list

Scenario: I create call forward settings
  When I click on add button
   And I fill out the form with "company/callForwardSettings/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "UsersList_callForwardSettings" subscreen list
  When I click on "callForwardSettings" last elements edit button
  Then I compare the form data with "company/callForwardSettings/new" data fixture

Scenario: I can save call forward settings
  Given I can see at least one row
   When I click on "CallForwardSettings" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "UsersList_callForwardSettings" subscreen list

Scenario: I can click on delete call forward settings button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "CallForwardSettings" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "UsersList_callForwardSettings" subscreen list
