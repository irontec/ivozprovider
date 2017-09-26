@platform
@domains

Feature: Domain admin page
  As a main operator
  I want to be able to access domains admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "Domains" CTA
  Then I am on "Domains" list

Scenario: I can see domains
  Given I can see at least one row
  And I click on "Domains" first elements view button
  And I click on close button
  Then I am on "Domains" list
