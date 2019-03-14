@brand
@carrierServers
@brand02
@brand02-2
@brand03

Feature: Carrier admin page
  As a main operator
  I want to be able to access carrier servers admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "Carriers" CTA
   Then I am on "Carriers" list
   When I click on "Carriers" first elements "carrierServers" button
   Then I am on "CarriersList_carrierServers" subscreen list

Scenario: I can create carrier servers
  When I click on add button
   And I fill out the form with "brand/carrierServers/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "CarriersList_carrierServers" subscreen list
  When I click on "carrierServers" last elements edit button
  Then I compare the form data with "brand/carrierServers/new" data fixture

Scenario: I can save carrier servers
  Given I can see at least one row
   When I click on "carrierServers" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "CarriersList_carrierServers" subscreen list

Scenario: I can click on delete carrier server button
  Given I can see at least one row
   When I click on "carrierServers" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "CarriersList_carrierServers" subscreen list
