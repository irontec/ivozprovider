@platform
@terminalModels

Feature: Terminal models operator admin page
  As a main operator
  I want to be able to access domains admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "TerminalManufacturers" CTA
  And I am on "TerminalManufacturers" list
  Then I can see at least one row
  Given I click on "TerminalManufacturers" first elements "terminalModels" button
  Then I am on "TerminalManufacturersList_terminalModels" subscreen list

Scenario: I can save terminal models
  Given I can see at least one row
  And I click on "TerminalModels" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "TerminalManufacturersList_terminalModels" subscreen list

Scenario: I see new terminal model admin page
  Given I click on add button
  And I click on close button
  Then I am on "TerminalManufacturersList_terminalModels" subscreen list

Scenario: I can click on delete terminal model button
  Given I can see at least one row
  And I click on "TerminalModels" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "TerminalManufacturersList_terminalModels" subscreen list
