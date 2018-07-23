@brand
@carriers
@brand02
@brand02-1
@brand03
@brand03-4
@brand13
@company05-1

Feature: Peering contracts admin page
  As a main operator
  I want to be able to access carriers admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
  Given I click on "Carriers" CTA
   Then I am on "Carriers" list

Scenario: I can create new carrier admin page
  Given I click on add button
    And I fill out the form with "brand/carriers/new" data fixture
   When I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Carriers" list
  When I click on "Carriers" last elements edit button
  Then I compare the form data with "brand/carriers/new" data fixture

Scenario: I can edit carriers
  Given I can see at least one row
   When I click on "Carriers" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Carriers" list

Scenario: I can click on delete carrier button
  Given I can see at least one row
   When I click on "Carriers" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "Carriers" list
