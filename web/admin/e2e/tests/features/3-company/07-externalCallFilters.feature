@company
@externalCallFilters
@company07

Feature: ExternalCallFilters admin page
  As a main operator
  I want to be able to access external call filters admin page
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
    And I click on "ExternalCallFilters" CTA
   Then I am on "ExternalCallFilters" list

Scenario: I create external call filters
  When I click on add button
   And I fill out the form with "company/externalCallFilters/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "ExternalCallFilters" list

Scenario: I can save ExternalCallFilters
  Given I can see at least one row
   When I click on "ExternalCallFilters" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "ExternalCallFilters" list

Scenario: I can click on delete user button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "ExternalCallFilters" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "ExternalCallFilters" list
