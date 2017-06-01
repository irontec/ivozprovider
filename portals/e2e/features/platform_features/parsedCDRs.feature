@platform
@parsedCDRs
@parsedCDRsPlatform

Feature: Parsed CDRs admin page
  As a main operator
  I want to be able to access parsed CDRs admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "ParsedCDRs" CTA
  And I am on "ParsedCDRs" list

Scenario: I can see parsed CDRs
  Given I can see at least one row
  And I click on "ParsedCDRs" first elements view button
  And I click on close button
  Then I am on "ParsedCDRs" list
