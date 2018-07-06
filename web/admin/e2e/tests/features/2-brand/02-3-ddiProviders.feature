@brand
@ddiProviders
@brand02
@brand02-1
@brand03
@brand03-4
@brand13
@company05-1

Feature: DDI Providers admin page
  As a main operator
  I want to be able to access ddi providers admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
  Given I click on "DdiProviders" CTA
   Then I am on "DdiProviders" list

Scenario: I can create new ddi provider admin page
  Given I click on add button
    And I fill out the form with "brand/ddiProviders/new" data fixture
   When I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "DdiProviders" list
  When I click on "DdiProviders" last elements edit button
  Then I compare the form data with "brand/ddiProviders/new" data fixture

Scenario: I can edit ddi providers
  Given I can see at least one row
   When I click on "DdiProviders" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "DdiProviders" list

Scenario: I can click on delete ddi provider button
  Given I can see at least one row
   When I click on "DdiProviders" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "DdiProviders" list
