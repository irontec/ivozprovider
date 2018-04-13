@platform
@proxyUsers
@platform04

Feature: Proxy Users admin page
  As a main operator
  I want to be able to access proxy users admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on "ProxyUsers" CTA
   Then I am on "ProxyUsers" list

Scenario: I can edit application servers
  Given I can see at least one row
   When I click on "ProxyUsers" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "ProxyUsers" list