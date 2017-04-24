@brand
@outgoingRouting
@todo

Feature: Outgoing routing admin page
  As a main operator
  I want to be able to access outgoing routing admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "Companies" CTA
  Then I am on "Companies" list
  Given I click on "Companies" first elements "outgoingRouting" button
  Then I am on "CompaniesList_outgoingRouting" subscreen list

#Scenario: I can save outgoing routing
#  Then I should implement further tests

Scenario: I see new outgoing routing admin page
  Given I click on add button
  And I click on close button
  Then I am on "CompaniesList_outgoingRouting" subscreen list

#Scenario: I can click on delete outgoing routing button
#  Then I should implement further tests
