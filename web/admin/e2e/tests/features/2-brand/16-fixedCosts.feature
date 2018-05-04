@brand
@fixedCosts
@brand16

Feature: Fixed costs admin page
  As a main operator
  I want to be able to access fixed costs admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "FixedCosts" CTA
   Then I am on "FixedCosts" list

Scenario: I can create fixed cost admin page
  When I click on add button
   And I fill out the form with "brand/fixedCosts/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "FixedCosts" list
  When I click on "FixedCosts" last elements edit button
  Then I compare the form data with "brand/fixedCosts/new" data fixture

Scenario: I can save fixed costs
  Given I can see at least one row
   When I click on "FixedCosts" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "FixedCosts" list

Scenario: I can click on delete fixed cost button
  Given I can see at least one row
   When I click on "FixedCosts" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "FixedCosts" list
