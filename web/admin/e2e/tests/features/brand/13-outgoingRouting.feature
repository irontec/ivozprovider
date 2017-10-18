@brand
@outgoingRouting
@brand13

Feature: Outgoing routing admin page
  As a main operator
  I want to be able to access outgoing routing admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "OutgoingRouting" CTA
   Then I am on "OutgoingRouting" list

Scenario: I can create new outgoing routings
   When I click on add button
    And I fill out the form with "brand/outgoingRouting/new" data fixture
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "OutgoingRouting" list

Scenario: I can edit outgoing routing
  Given I can see at least one row
   When I click on "OutgoingRouting" first elements edit button
    And I click on save button
   Then I can see confirmation dialog within "50" seconds or lower
   When I click on close dialog button
   Then I am on "OutgoingRouting" list

Scenario: I can click on delete outgoing routing button
  Given I can see at least one row
   When I click on "OutgoingRouting" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "OutgoingRouting" list
