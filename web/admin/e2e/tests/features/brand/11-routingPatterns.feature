@brand
@routingPatterns
@11

Feature: Routing patterns admin page
  As a main operator
  I want to be able to access routing patterns admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "RoutingPatterns" CTA
   Then I am on "RoutingPatterns" list

Scenario: I create new routing patterns
   When I click on add button
    And I fill out the form with "brand/routingPatterns/new" data fixture
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "RoutingPatterns" list

Scenario: I can save routing patterns
  Given I can see at least one row
   When I click on "RoutingPatterns" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "RoutingPatterns" list

Scenario: I can click on delete routing pattern button
  Given I can see at least one row
   When I click on "RoutingPatterns" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "RoutingPatterns" list
