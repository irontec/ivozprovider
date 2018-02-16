@company
@extensions
@company02
@company03

Feature: Extensions admin page
  As a main operator
  I want to be able to access extensions admin page
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
    And I click on "Extensions" CTA
   Then I am on "Extensions" list

Scenario: I create termimals
  When I click on add button
   And I fill out the form with "company/extensions/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "Extensions" list

Scenario: I can edit extensions
  Given I can see at least one row
   When I click on "Extensions" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Extensions" list

Scenario: I can click on delete user button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "Extensions" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Extensions" list
