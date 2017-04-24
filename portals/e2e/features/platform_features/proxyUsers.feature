@platform
@proxyUsers

Feature: Proxy Users admin page
  As a main operator
  I want to be able to access proxy users admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "ProxyUsers" CTA
  Then I am on "ProxyUsers" list

Scenario: I can save application servers
  Given I can see at least one row
  And I click on "ProxyUsers" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "ProxyUsers" list
