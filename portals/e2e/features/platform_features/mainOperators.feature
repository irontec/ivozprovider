@platform
@mainOperators

Feature: Main operators admin page
  As a main operator
  I want to be able to access main operators admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "MainOperators" CTA
  Then I am on "MainOperators" list

Scenario: I can save main operators
  Given I can see at least one row
  And I click on "MainOperators" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "MainOperators" list

Scenario: I see new main operator admin page
  Given I click on add button
  And I click on close button
  Then I am on "MainOperators" list

Scenario: I can click on delete main operator button
  Given I can see at least one row
  And I click on "MainOperators" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "MainOperators" list
