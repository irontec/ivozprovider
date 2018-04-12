@brand
@genericMusicOnHold
@brand06

Feature: Generic music on hold admin page
  As a main operator
  I want to be able to access generic music on hold admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "GenericMusicOnHold" CTA
   Then I am on "GenericMusicOnHold" list

Scenario: I can create new generic music on hold
   When I click on add button
    And I fill out the form with "brand/genericMusicOnHold/new" data fixture
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "GenericMusicOnHold" list
  When I click on "musicOnHold" last elements edit button
  Then I compare the form data with "brand/genericMusicOnHold/compareNew" data fixture

Scenario: I can edit generic music on hold
  Given I can see at least one row
   When I click on "musicOnHold" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "GenericMusicOnHold" list

Scenario: I can click on delete generic music on hold button
  Given I can see at least one row
   When I click on "musicOnHold" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "GenericMusicOnHold" list
