@company
@queueMembers
@company18
@company18-2

Feature: Queues admin page
  As a main operator
  I want to be able to access queues admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "Queues" CTA
   Then I am on "Queues" list
   When I click on "Queues" first elements "queueMembers" button
   Then I am on "QueuesList_queueMembers" subscreen list

Scenario: I create queue members
  When I click on add button
   And I fill out the form with "company/queueMembers/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "QueuesList_queueMembers" subscreen list
  When I click on "queueMembers" last elements edit button
  Then I compare the form data with "company/queueMembers/new" data fixture

Scenario: I can save queue members
  Given I can see at least one row
   When I click on "queueMembers" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "QueuesList_queueMembers" subscreen list

Scenario: I can click on delete queue member button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "queueMembers" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "QueuesList_queueMembers" subscreen list
