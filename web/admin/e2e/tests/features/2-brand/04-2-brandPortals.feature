@brand
@clientPortals
@brand04
@login

Feature: Company URLs admin page
  As a main operator
  I want to be able to access company URLs admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
  When I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "ClientPortals" CTA
  Then I am on "ClientPortals" list

Scenario: I can create new company URL
  When I click on add button
  And I fill out the form with "brand/webPortals/admin" data fixture
  And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "ClientPortals" list
  When I click on "companyPortals" last elements edit button
  Then I compare the form data with "brand/webPortals/admin" data fixture
