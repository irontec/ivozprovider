@brand
@billableCalls
@kamAccCdrsBrand
@17
@skip

Feature: Billable calls admin page
  As a main operator
  I want to be able to access billable calls admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "KamTrunksCdrsBrand" CTA
   Then I am on "KamTrunksCdrsBrand" list

Scenario: I can see billable calls
  Given I can see at least one row
   When I click on "KamTrunksCdrs" first elements view button
    And I click on close button
   Then I am on "KamTrunksCdrsBrand" list
