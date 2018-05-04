@company
@matchLists
@company06
@company06-2
@company09

Feature: MatchLists admin page
  As a main operator
  I want to be able to access match lists admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "MatchLists" CTA
   Then I am on "MatchLists" list

Scenario: I create match lists
  When I click on add button
   And I fill out the form with "company/matchLists/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "MatchLists" list
  When I click on "MatchLists" last elements edit button
  Then I compare the form data with "company/matchLists/new" data fixture

Scenario: I can save MatchLists
  Given I can see at least one row
   When I click on "MatchLists" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "MatchLists" list

Scenario: I can click on delete user button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "MatchLists" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "MatchLists" list
