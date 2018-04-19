@platform
@antifloodTrustedIPs
@kamTrusted
@platform07

Feature: Antiflood Trusted IPs admin page
  As a main operator
  I want to be able to access antiflood trusted IPs admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on "KamTrusted" CTA
   Then I am on "KamTrusted" list

Scenario: I can create antiflood trusted IPs
  When I click on add button
   And I fill out the form with "platform/antifloodTrustedIPs/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "KamTrusted" list
  When I click on "KamTrusted" last elements edit button
  Then I compare the form data with "platform/antifloodTrustedIPs/new" data fixture

Scenario: I can save antiflood trusted IPs
  Given I can see at least one row
   When I click on "KamTrusted" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "KamTrusted" list

Scenario: I can click on delete antiflood trusted IP button
  Given I can see at least one row
   When I click on "KamTrusted" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "KamTrusted" list
