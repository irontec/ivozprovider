@platform
@antifloodTrustedIPs
@kamPikeTrusted
@07

Feature: Antiflood Trusted IPs admin page
  As a main operator
  I want to be able to access antiflood trusted IPs admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on "KamPikeTrusted" CTA
   Then I am on "KamPikeTrusted" list

Scenario: I see create antiflood trusted IPs
  When I click on add button
   And I fill out the form with "platform/antifloodTrustedIPs/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "KamPikeTrusted" list

Scenario: I can save antiflood trusted IPs
  Given I can see at least one row
   When I click on "KamPikeTrusted" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "KamPikeTrusted" list

Scenario: I can click on delete antiflood trusted IP button
  Given I can see at least one row
   When I click on "KamPikeTrusted" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "KamPikeTrusted" list
