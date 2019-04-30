@company
@friends
@company04
@company04-1

Feature: Friends patterns admin page
  As a main operator
  I want to be able to access friends admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "Friends" CTA
   Then I am on "Friends" list
   When I click on "Friends" first elements "friendsPatterns" button
   Then I am on "FriendsList_friendsPatterns" subscreen list

Scenario: I create friend pattern
  When I click on add button
   And I fill out the form with "company/friendsPatterns/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "FriendsList_friendsPatterns" subscreen list
  When I click on "friendsPatterns" last elements edit button
  Then I compare the form data with "company/friendsPatterns/new" data fixture

Scenario: I can save friends patterns
  Given I can see at least one row
   When I click on "friendsPatterns" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
  Then I am on "FriendsList_friendsPatterns" subscreen list

Scenario: I can click on delete friends pattern button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "friendsPatterns" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
  Then I am on "FriendsList_friendsPatterns" subscreen list
