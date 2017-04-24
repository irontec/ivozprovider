@brand
@billableCalls
@kamAccCdrsBrand
@todo

Feature: Billable calls admin page
  As a main operator
  I want to be able to access billable calls admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "KamAccCdrsBrand" CTA
  Then I am on "KamAccCdrsBrand" list

Scenario: I can see domains
  Given I can see at least one row
  And I click on "kamAccCdrs" first elements view button
  And I click on close button
  Then I am on "KamAccCdrsBrand" list
