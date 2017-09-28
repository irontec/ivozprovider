@brand
@invoices

Feature: Invoices admin page
  As a main operator
  I want to be able to access invoices admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "Invoices" CTA
  Then I am on "Invoices" list

Scenario: I can save invoices
  Given I can see at least one row
  And I click on "Invoices" first elements edit button
  And I click on save button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "Invoices" list

Scenario: I see new invoice admin page
  Given I click on add button
  And I click on close button
  Then I am on "Invoices" list

Scenario: I can click on delete invoice button
  Given I can see at least one row
  And I click on "Invoices" first elements delete button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "Invoices" list
