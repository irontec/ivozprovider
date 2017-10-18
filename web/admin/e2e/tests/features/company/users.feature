@company
@users
@todo

Feature: Users admin page
  As a main operator
  I want to be able to access users admin page
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

Scenario: I can save Users
  Given I can see at least one row
   When I click on "Users" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Users" list

Scenario: I see new user admin page
  Given I click on add button
  And I click on close button
  Then I am on "Users" list

Scenario: I can click on delete user button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "Users" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Users" list
