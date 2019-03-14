@company
@huntGroupsRelUsersFilterRingAll
@company14

Feature: Hunt groups rel users filter ring all admin page
  As a main operator
  I want to be able to access hunt groups rel users filter ring all admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "HuntGroups" CTA
   Then I am on "HuntGroups" list
   When I click on "HuntGroups" first elements "huntGroupsRelUsersFilterRingAll" button
   Then I am on "HuntGroupsList_huntGroupsRelUsersFilterRingAll" subscreen list

Scenario: I create hunt groups rel users filter ring all
  When I click on add button
   And I fill out the form with "company/huntGroupsRelUsersFilterRingAll/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "HuntGroupsList_huntGroupsRelUsersFilterRingAll" subscreen list
  When I click on "huntGroupsRelUsersFilterRingAll" last elements edit button
  Then I compare the form data with "company/huntGroupsRelUsersFilterRingAll/new" data fixture

Scenario: I can save hunt groups rel users filter ring all
  Given I can see at least one row
   When I click on "huntGroupsRelUsersFilterRingAll" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "HuntGroupsList_huntGroupsRelUsersFilterRingAll" subscreen list

Scenario: I can click on delete hunt groups rel users filter ring all button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "huntGroupsRelUsers" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "HuntGroupsList_huntGroupsRelUsersFilterRingAll" subscreen list
