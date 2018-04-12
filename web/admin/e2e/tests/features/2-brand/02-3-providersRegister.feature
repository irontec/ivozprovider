@brand
@providersRegister
@kamTrunksUacreg
@brand02
@brand02-3

Feature: Peer servers admin page
  As a main operator
  I want to be able to access peer servers admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "PeeringContracts" CTA
   Then I am on "PeeringContracts" list
   When I click on "PeeringContracts" first elements "kamTrunksUacreg" button
   Then I am on "PeeringContractsList_kamTrunksUacreg" subscreen list

Scenario: I can create peer servers
  When I click on add button
   And I fill out the form with "brand/providersRegister/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "PeeringContractsList_kamTrunksUacreg" subscreen list
  When I click on "kamTrunksUacreg" last elements edit button
  Then I compare the form data with "brand/providersRegister/compare" data fixture

Scenario: I can save providers registers
  Given I can see at least one row
   When I click on "kamTrunksUacreg" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "PeeringContractsList_kamTrunksUacreg" subscreen list

Scenario: I can click on delete providers register button
  Given I can see at least one row
   When I click on "kamTrunksUacreg" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "PeeringContractsList_kamTrunksUacreg" subscreen list
