@brand
@companies
@brand03
@brand03-1
@brand03-2
@brand03-3
@brand03-4
@brand03-5

Feature: Companies admin page
  As a main operator
  I want to be able to access companies admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "Companies" CTA
   Then I am on "Companies" list

Scenario: I create new companies
  When I click on add button
   And I fill out the form with "brand/company/new" data fixture
  When I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "Companies" list
  When I click on "Companies" last elements edit button
  Then I compare the form data with "brand/company/new" data fixture

Scenario: I can edit companies
  Given I can see at least one row
   When I click on "Companies" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Companies" list

Scenario: I can click on delete companies button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "Companies" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Companies" list
