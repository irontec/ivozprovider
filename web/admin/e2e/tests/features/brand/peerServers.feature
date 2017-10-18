@brand
@peerServers
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
   When I click on "PeeringContracts" first elements "peerServers" button
   Then I am on "PeeringContractsList_peerServers" subscreen list

Scenario: I can save peer servers
  Given I can see at least one row
   When I click on "peerServers" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "PeeringContractsList_peerServers" subscreen list

Scenario: I see new peer servers admin page
  Given I click on add button
  And I click on close button
  Then I am on "PeeringContractsList_peerServers" subscreen list

Scenario: I can click on delete peer server button
  Given I can see at least one row
   When I click on "peerServers" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "PeeringContractsList_peerServers" subscreen list
