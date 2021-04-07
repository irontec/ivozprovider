@company
@matchLists
@company09
@company09-2

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
   When I click on "MatchLists" first elements "matchListPatterns" button
   Then I am on "MatchListsList_matchListPatterns" subscreen list

Scenario: I create match lists
  When I click on add button
   And I fill out the form with "company/matchListPatterns/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "MatchListsList_matchListPatterns" subscreen list
  When I click on "matchListPatterns" last elements edit button
  Then I compare the form data with "company/matchListPatterns/new" data fixture

Scenario: I can save match lists
  Given I can see at least one row
   When I click on "matchListPatterns" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "MatchListsList_matchListPatterns" subscreen list

Scenario: I can click on delete match list button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "matchListPatterns" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "MatchListsList_matchListPatterns" subscreen list
