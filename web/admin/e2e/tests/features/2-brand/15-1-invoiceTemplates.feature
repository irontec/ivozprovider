@brand
@invoiceTemplates
@brand15
@brand15-1

Feature: Invoice templates admin page
  As a main operator
  I want to be able to access invoice templates admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "InvoiceTemplates" CTA
   Then I am on "InvoiceTemplates" list

Scenario: I can create invoice templates
  When I click on add button
   And I fill out the form with "brand/invoiceTemplates/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "InvoiceTemplates" list

Scenario: I can save invoice templates
  Given I can see at least one row
   When I click on "InvoiceTemplates" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "InvoiceTemplates" list

Scenario: I can click on delete invoice template button
  Given I can see at least one row
   When I click on "InvoiceTemplates" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "InvoiceTemplates" list
