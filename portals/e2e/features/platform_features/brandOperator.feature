@platform
@brandOperators

Feature: Brand operator admin page
  As a main operator
  I want to be able to access domains admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "Brands" CTA
  Then I am on "Brands" list
  Given I can see at least one row
  And I click on "Brands" first elements "brandOperators" button
  Then I am on "BrandsList_brandOperators" subscreen list

Scenario: I can save brand operators
  Given I can see at least one row
  And I click on "BrandOperators" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "BrandsList_brandOperators" subscreen list

Scenario: I see new brand operator admin page
  Given I click on add button
  And I click on close button
  Then I am on "BrandsList_brandOperators" subscreen list

Scenario: I can click on delete brand button
  Given I can see at least one row
  And I click on "BrandOperators" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "BrandsList_brandOperators" subscreen list
