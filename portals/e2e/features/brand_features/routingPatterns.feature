@brand
@routingPatterns

Feature: Routing patterns admin page
  As a main operator
  I want to be able to access routing patterns admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "RoutingPatterns" CTA
  Then I am on "RoutingPatterns" list

Scenario: I can save routing patterns
  Given I can see at least one row
  And I click on "RoutingPatterns" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "RoutingPatterns" list

Scenario: I see new routing pattern admin page
  Given I click on add button
  And I click on close button
  Then I am on "RoutingPatterns" list

Scenario: I can click on delete routing pattern button
  Given I can see at least one row
  And I click on "RoutingPatterns" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "RoutingPatterns" list
