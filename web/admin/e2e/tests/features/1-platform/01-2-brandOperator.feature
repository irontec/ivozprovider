@platform
@login
@brandOperators
@platform01
@platform01-2

Feature: Brand operator admin page
  As a main operator
  I want to be able to access domains admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on "Brands" CTA
   Then I am on "Brands" list
    And I can see at least one row
   When I click on "Brands" first elements "administrators" button
   Then I am on "BrandsList_administrators" subscreen list

Scenario: I create new brand operator admin page
  When I click on add button
   And I fill out the form with "platform/brandOperators/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "BrandsList_administrators" subscreen list
  When I click on "administrators" last elements edit button
  Then I compare the form data with "platform/brandOperators/new" data fixture

Scenario: I can edit brand operators
  Given I can see at least one row
   When I click on "administrators" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "BrandsList_administrators" subscreen list

Scenario: I can click on delete brand operator button
  Given I can see at least one row
   When I click on "administrators" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "BrandsList_administrators" subscreen list
