@brand
@companyURLs

Feature: Company URLs admin page
  As a main operator
  I want to be able to access company URLs admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "CompanyURLs" CTA
  Then I am on "CompanyURLs" list

Scenario: I can save company URLs
  Given I can see at least one row
  And I click on "CompanyURLs" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "CompanyURLs" list

Scenario: I see new company URL admin page
  Given I click on add button
  And I click on close button
  Then I am on "CompanyURLs" list

Scenario: I can click on delete company URL button
  Given I can see at least one row
  And I click on "CompanyURLs" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "CompanyURLs" list
