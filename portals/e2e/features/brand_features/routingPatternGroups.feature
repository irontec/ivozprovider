@brand
@routingPatternGroups

Feature: Routing pattern groups admin page
  As a main operator
  I want to be able to access routing pattern groups admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "RoutingPatternGroups" CTA
  Then I am on "RoutingPatternGroups" list

Scenario: I can save routing pattern groups
  Given I can see at least one row
  And I click on "RoutingPatternGroups" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "RoutingPatternGroups" list

Scenario: I see new routing pattern group admin page
  Given I click on add button
  And I click on close button
  Then I am on "RoutingPatternGroups" list

Scenario: I can click on delete routing pattern group button
  Given I can see at least one row
  And I click on "RoutingPatternGroups" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "RoutingPatternGroups" list
