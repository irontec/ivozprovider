@brand
@outgoingRouting

Feature: Outgoing routing admin page
  As a main operator
  I want to be able to access outgoing routing admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "OutgoingRouting" CTA
  Then I am on "OutgoingRouting" list

Scenario: I can save outgoing routing
  Given I can see at least one row
  And I click on "OutgoingRouting" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  And I click on close dialog button
  Then I am on "OutgoingRouting" list

Scenario: I see new outgoing routing admin page
  Given I click on add button
  And I click on close button
  Then I am on "OutgoingRouting" list

Scenario: I can click on delete outgoing routing button
  Given I can see at least one row
  And I click on "OutgoingRouting" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "OutgoingRouting" list
