@company
@huntGroupsRelUsers
@company03
@company03-2

Feature: Users admin page
  As a main operator
  I want to be able to access hunt groups rel users admin page
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
    And I click on "Users" CTA
   Then I am on "Users" list
   When I click on "Users" first elements "huntGroupsRelUsers" button
   Then I am on "UsersList_huntGroupsRelUsers" subscreen list

Scenario: I create hunt groups rel users
  When I click on add button
   And I fill out the form with "company/huntGroupsRelUsers/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "UsersList_huntGroupsRelUsers" subscreen list

Scenario: I can save hunt groups rel users
  Given I can see at least one row
   When I click on "huntGroupsRelUsers" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "UsersList_huntGroupsRelUsers" subscreen list

Scenario: I can click on delete hunt groups rel users button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "huntGroupsRelUsers" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "UsersList_huntGroupsRelUsers" subscreen list
