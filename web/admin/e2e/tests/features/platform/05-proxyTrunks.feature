@platform
@proxyTrunks
@05

Feature: Proxy Trunks admin page
  As a main operator
  I want to be able to access proxy trunks admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on "ProxyTrunks" CTA
   Then I am on "ProxyTrunks" list

Scenario: I can edit application servers
  Given I can see at least one row
   When I click on "ProxyTrunks" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "ProxyTrunks" list
