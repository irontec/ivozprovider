@company
@ivrEntries
@company17
@company17-2

Feature: Ivr entries admin page
  As a main operator
  I want to be able to access custom IVRs admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "Ivr" CTA
   Then I am on "Ivr" list
   When I click on "Ivr" first elements "ivrEntries" button
   Then I am on "IvrList_ivrEntries" subscreen list

Scenario: I create custom IVR entries
  When I click on add button
   And I fill out the form with "company/ivrEntries/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "IvrList_ivrEntries" subscreen list
  When I click on "ivrEntries" last elements edit button
  Then I compare the form data with "company/ivrEntries/new" data fixture

Scenario: I can save Ivr entry
  Given I can see at least one row
   When I click on "ivrEntries" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "IvrList_ivrEntries" subscreen list

Scenario: I can click on delete user button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "ivrEntries" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "IvrList_ivrEntries" subscreen list
