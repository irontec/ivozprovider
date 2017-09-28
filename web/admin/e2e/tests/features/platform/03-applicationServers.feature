@platform
@applicationServers

Feature: Application Server admin page
  As a main operator
  I want to be able to access application server admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on "ApplicationServers" CTA
   Then I am on "ApplicationServers" list

Scenario: I see create application servers
  When I click on add button
   And I fill out the form with "platform/applicationServer/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "ApplicationServers" list

Scenario: I can save application servers
  Given I can see at least one row
   When I click on "ApplicationServers" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "ApplicationServers" list

Scenario: I can click on delete Application server button
  Given I can see at least one row
   When I click on "ApplicationServers" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "ApplicationServers" list
