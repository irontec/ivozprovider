@company
@faxes
@company22

Feature: Faxes admin page
  As a main operator
  I want to be able to access conference rooms admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "Faxes" CTA
   Then I am on "Faxes" list

Scenario: I can create company faxes
  When I click on add button
   And I fill out the form with "company/faxes/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "Faxes" list
  When I click on "Faxes" last elements edit button
  Then I compare the form data with "company/faxes/new" data fixture

Scenario: I can edit company faxes
  Given I can see at least one row
   When I click on "Faxes" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Faxes" list

Scenario: I can click on delete fax button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "Faxes" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Faxes" list
