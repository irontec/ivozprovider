@company
@huntGroupsRelUsers
@company03
@company03-4

Feature: Users admin page
  As a main operator
  I want to be able to access hunt groups rel users admin page
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
   When I click on "Users" first elements "huntGroupsRelUsers" button
   Then I am on "UsersList_huntGroupsRelUsers" subscreen list

Scenario: I can click on delete hunt groups rel users button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "huntGroupsRelUsers" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "UsersList_huntGroupsRelUsers" subscreen list
