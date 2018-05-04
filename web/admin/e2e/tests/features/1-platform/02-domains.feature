@platform
@domains
@platform02
@skip

Feature: Domain admin page
  As a main operator
  I want to be able to access domains admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on "Domains" CTA
   Then I am on "Domains" list

Scenario: I can see domains
  Given I can see at least one row

