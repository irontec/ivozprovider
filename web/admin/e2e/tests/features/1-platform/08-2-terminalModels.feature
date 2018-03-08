@platform
@terminalModels
@platform08
@platform08-2

Feature: Terminal models operator admin page
  As a main operator
  I want to be able to access domains admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on "TerminalManufacturers" CTA
   Then I am on "TerminalManufacturers" list
    And I can see at least one row
   When I click on "TerminalManufacturers" first elements "terminalModels" button
   Then I am on "TerminalManufacturersList_terminalModels" subscreen list

Scenario: I create new terminal model admin page
  When I click on add button
   And I fill out the form with "platform/terminalModel/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "TerminalManufacturersList_terminalModels" subscreen list
  When I click on "terminalModels" last elements edit button
  Then I compare the form data with "platform/terminalModel/new" data fixture

Scenario: I can edit terminal models
  Given I can see at least one row
   When I click on "TerminalModels" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TerminalManufacturersList_terminalModels" subscreen list

Scenario: I can click on delete terminal model button
  Given I can see at least one row
   When I click on "TerminalModels" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TerminalManufacturersList_terminalModels" subscreen list
