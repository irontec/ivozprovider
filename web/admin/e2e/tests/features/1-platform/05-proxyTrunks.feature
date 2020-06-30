@platform
@proxyTrunks
@platform05

Feature: Proxy Trunks admin page
  As a main operator
  I want to be able to access proxy trunks admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on "ProxyTrunks" CTA
   Then I am on "ProxyTrunks" list

Scenario: I can edit application servers
  Given I can see at least one row
##########################################################################################################
#  screen is called proxyTrunksEditMain_screen now, it'll require some development in order to be tested
##########################################################################################################
#   When I click on "ProxyTrunks" first elements edit button
#    And I click on save button
#   Then I can see confirmation dialog
#   When I click on close dialog button
#   Then I am on "ProxyTrunks" list
