@brand
@companyAdmins

Feature: Company admins admin page
  As a main operator
  I want to be able to access company admins admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "Companies" CTA
  Then I am on "Companies" list
  Given I click on "Companies" first elements "companyAdmins" button
  Then I am on "CompaniesList_companyAdmins" subscreen list

Scenario: I can save company admins
  Given I can see at least one row
  And I click on "companyAdmins" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "CompaniesList_companyAdmins" subscreen list

Scenario: I see new company admins admin page
  Given I click on add button
  And I click on close button
  Then I am on "CompaniesList_companyAdmins" subscreen list

Scenario: I can click on delete company admin button
  Given I can see at least one row
  And I click on "companyAdmins" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "CompaniesList_companyAdmins" subscreen list
