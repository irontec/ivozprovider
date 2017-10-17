@platform
@brands
@01-1

Feature: Brand admin page
  As a main operator
  I want to be able to access brand admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on "Brands" CTA
   Then I am on "Brands" list

Scenario: I can create brands
  When I click on add button
   And I fill out the form with "platform/brand/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "Brands" list

Scenario: I can edit brands
  Given I can see at least one row
   When I click on "Brands" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
  Given I click on close dialog button
   Then I am on "Brands" list

Scenario: I can click on delete brand button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "Brands" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Brands" list
