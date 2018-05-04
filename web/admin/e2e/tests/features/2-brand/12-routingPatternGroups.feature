@brand
@routingPatternGroups
@brand12

Feature: Routing pattern groups admin page
  As a main operator
  I want to be able to access routing pattern groups admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "RoutingPatternGroups" CTA
   Then I am on "RoutingPatternGroups" list

Scenario: I create new routing pattern group admin page
  When I click on add button
   And I fill out the form with "brand/routingPatternGroups/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "RoutingPatternGroups" list
  When I click on "RoutingPatternGroups" last elements edit button
  Then I compare the form data with "brand/routingPatternGroups/new" data fixture

Scenario: I can save routing pattern groups
  Given I can see at least one row
   When I click on "RoutingPatternGroups" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "RoutingPatternGroups" list

Scenario: I can click on delete routing pattern group button
  Given I can see at least one row
   When I click on "RoutingPatternGroups" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "RoutingPatternGroups" list
