@brand
@genericMusicOnHold

Feature: Generic music on hold admin page
  As a main operator
  I want to be able to access generic music on hold admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "GenericMusicOnHold" CTA
  Then I am on "GenericMusicOnHold" list

Scenario: I can edit generic music on hold
  Given I can see at least one row
  And I click on "GenericMusicOnHold" first elements edit button
  And I click on save button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "GenericMusicOnHold" list

Scenario: I see new generic music on hold admin page
  Given I click on add button
  And I click on close button
  Then I am on "GenericMusicOnHold" list

Scenario: I can click on delete generic music on hold button
  Given I can see at least one row
  And I click on "GenericMusicOnHold" first elements delete button
  Then I can see confirmation dialog
  Given I click on close dialog button
  Then I am on "GenericMusicOnHold" list
