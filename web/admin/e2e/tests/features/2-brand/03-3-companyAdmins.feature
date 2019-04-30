@brand
@login
@companyAdmins
@brand03
@brand03-3

Feature: Company admin admin page
  As a main operator
  I want to be able to access company admin admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "Companies" CTA
   Then I am on "Companies" list
   When I click on "Companies" first elements "administrators" button
   Then I am on "CompaniesList_administrators" subscreen list

Scenario: I can create new company admin
  When I click on add button
   And I fill out the form with "brand/companyAdmins/new" data fixture
  When I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "CompaniesList_administrators" subscreen list
  When I click on "administrators" last elements edit button
  Then I compare the form data with "brand/companyAdmins/new" data fixture

Scenario: I can edit authorized sources
  Given I can see at least one row
   When I click on "administrators" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "CompaniesList_administrators" subscreen list

Scenario: I can click on delete authorized sources button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "administrators" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "CompaniesList_administrators" subscreen list

