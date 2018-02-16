@company
@conditionalRoutesConditions
@company08
@company08-2

Feature: conditional routes conditions admin page
  As a main operator
  I want to be able to access conditional routes conditions admin page
  emulating brand operator
  emulating company operator
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on company emulation button
    And I emulate the company at position "1"
    And I click on "ConditionalRoutes" CTA
   Then I am on "ConditionalRoutes" list
   When I click on "ConditionalRoutes" first elements "conditionalRoutesConditions" button
   Then I am on "ConditionalRoutesList_conditionalRoutesConditions" subscreen list

Scenario: I create conditional routes conditions
  When I click on add button
   And I fill out the form with "company/conditionalRoutesConditions/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "ConditionalRoutesList_conditionalRoutesConditions" subscreen list

Scenario: I can save conditional routes conditions
  Given I can see at least one row
   When I click on "conditionalRoutesConditions" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "ConditionalRoutesList_conditionalRoutesConditions" subscreen list

Scenario: I can click on delete conditional routes condition button
  Given I can see at least one row
   When I select element at position "1"
    And I click on "conditionalRoutesConditions" delete button in the footer
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "ConditionalRoutesList_conditionalRoutesConditions" subscreen list
