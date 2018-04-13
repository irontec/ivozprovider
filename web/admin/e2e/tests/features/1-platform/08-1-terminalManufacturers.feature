@platform
@terminalManufacturers
@platform08
@platform08-1

Feature: Terminal manufacturers admin page
  As a main operator
  I want to be able to access terminal manufacturers admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on "TerminalManufacturers" CTA
   Then I am on "TerminalManufacturers" list

Scenario: I create terminal manufacturers
  Given I click on add button
  And I fill out the form with "platform/terminalManufacturer/new" data fixture
  And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "TerminalManufacturers" list
  When I click on "TerminalManufacturers" last elements edit button
  Then I compare the form data with "platform/terminalManufacturer/new" data fixture

Scenario: I can edit terminal manufacturers
  Given I can see at least one row
   When I click on "TerminalManufacturers" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
  When I click on close dialog button
   Then I am on "TerminalManufacturers" list

Scenario: I can click on delete terminal manufacturer button
  Given I can see at least one row
   When I click on "TerminalManufacturers" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TerminalManufacturers" list
