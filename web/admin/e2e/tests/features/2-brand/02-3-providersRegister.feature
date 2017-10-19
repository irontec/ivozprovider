@brand
@providersRegister
@kamTrunksUacreg
@brand02
@brand02-3
@todo

Feature: Peer servers admin page
  As a main operator
  I want to be able to access peer servers admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "PeeringContracts" CTA
   Then I am on "PeeringContracts" list
   When I click on "PeeringContracts" first elements "kamTrunksUacreg" button
   Then I am on "PeeringContractsList_kamTrunksUacreg" subscreen list

Scenario: I see new providers register admin page
  Given I click on add button
  And I click on close button
  Then I am on "PeeringContractsList_kamTrunksUacreg" subscreen list

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
