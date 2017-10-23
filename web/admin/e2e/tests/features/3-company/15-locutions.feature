@company
@pickUpGroups
@company15
@skip

Feature: PickUpGroups admin page
  As a main operator
  I want to be able to access pick up groups admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "PickUpGroups" CTA
   Then I am on "PickUpGroups" list

Scenario: I create pick up groups
  When I click on add button
   And I fill out the form with "company/pickUpGroups/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "PickUpGroups" list

Scenario: I can save PickUpGroups
  Given I can see at least one row
   When I click on "PickUpGroups" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "PickUpGroups" list

Scenario: I can click on delete user button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "PickUpGroups" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "PickUpGroups" list
