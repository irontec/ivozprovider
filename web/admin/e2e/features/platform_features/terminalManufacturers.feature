@platform
@terminalManufacturers

Feature: Terminal manufacturers admin page
  As a main operator
  I want to be able to access terminal manufacturers admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "TerminalManufacturers" CTA
  Then I am on "TerminalManufacturers" list

Scenario: I can save terminal manufacturers
  Given I can see at least one row
  And I click on "TerminalManufacturers" first elements edit button
  And I click on save button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "TerminalManufacturers" list

Scenario: I see new terminal manufacturer admin page
  Given I click on add button
  And I click on close button
  Then I am on "TerminalManufacturers" list

Scenario: I can click on delete terminal manufacturer button
  Given I can see at least one row
  And I click on "TerminalManufacturers" first elements delete button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "TerminalManufacturers" list
