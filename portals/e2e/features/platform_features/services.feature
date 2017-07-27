@platform
@services

Feature: Services admin page
  As a main operator
  I want to be able to access services admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "Services" CTA
  Then I am on "Services" list

Scenario: I can save services
  Given I can see at least one row
  And I click on "Services" first elements edit button
  And I click on save button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "Services" list
