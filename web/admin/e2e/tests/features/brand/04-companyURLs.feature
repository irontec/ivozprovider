@brand
@companyURLs
@brand04

Feature: Company URLs admin page
  As a main operator
  I want to be able to access company URLs admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "CompanyURLs" CTA
   Then I am on "CompanyURLs" list

Scenario: I can add new company URL
  When I click on add button
   And I fill out the form with "brand/companyURLs/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "CompanyURLs" list

Scenario: I can edit company URLs
  Given I can see at least one row
   When I click on "CompanyURLs" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
  Given I click on close dialog button
   Then I am on "CompanyURLs" list

Scenario: I can click on delete company URL button
  Given I can see at least one row
    And I click on "CompanyURLs" first elements delete button
   Then I can see confirmation dialog
  Given I click on close dialog button
   Then I am on "CompanyURLs" list
