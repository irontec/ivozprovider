@platform
@brands

Feature: Brand admin page
  As a main operator
  I want to be able to access brand admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "Brands" CTA
  Then I am on "Brands" list

Scenario: I can save brands
  Given I can see at least one row
  And I click on "Brands" first elements edit button
  And I click on save button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "Brands" list

Scenario: I see new brand admin page
  Given I click on add button
  And I click on close button
  Then I am on "Brands" list

Scenario: I can click on delete brand button
  Given I can see at least one row
  Then I select element at position "1"
  And I click on "Brands" delete button in the footer
  Given I can see confirmation dialog
  And I click on close dialog button
  Then I am on "Brands" list
