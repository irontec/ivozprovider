@brand
@authorizedSources
@kamUsersAddress
@todo

Feature: Authorized sources admin page
  As a main operator
  I want to be able to access authorized sources admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on brand emulation button
  And I emulate the brand at position "1"
  And I click on "Companies" CTA
  Then I am on "Companies" list
  Given I click on "Companies" first elements "kamUsersAddress" button
  Then I am on "CompaniesList_kamUsersAddress" subscreen list

#Scenario: I can save authorized sources
#  Then I should implement further tests

Scenario: I see new authorized sources admin page
  Given I click on add button
  And I click on close button
  Then I am on "CompaniesList_kamUsersAddress" subscreen list

#Scenario: I can click on delete brand button
#  Then I should implement further tests
