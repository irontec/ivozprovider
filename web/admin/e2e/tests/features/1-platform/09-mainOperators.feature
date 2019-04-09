@platform
@login
@mainOperators
@platform09

Feature: Main operators admin page
  As a main operator
  I want to be able to access main operators admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on "Administrators" CTA
   Then I am on "Administrators" list

Scenario: I can create main operators
  When I click on add button
   And I fill out the form with "platform/mainOperators/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "Administrators" list
  When I click on "Administrators" last elements edit button
  Then I compare the form data with "platform/mainOperators/new" data fixture

Scenario: I can edit main operators
  Given I can see at least one row
   When I click on "Administrators" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Administrators" list

Scenario: I can click on delete main operator button
  Given I can see at least one row
   When I click on "Administrators" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Administrators" list
