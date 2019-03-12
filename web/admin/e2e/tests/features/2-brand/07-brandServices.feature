@brand
@brandServices
@brand07

Feature: Generic brand services admin page
  As a main operator
  I want to be able to access brand services admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "BrandServices" CTA
   Then I am on "BrandServices" list

Scenario: I can edit brand service
  Given I can see at least one row
   When I click on "BrandServices" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "BrandServices" list

Scenario: I can click on delete brand services button
  Given I can see at least one row
   When I click on "BrandServices" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "BrandServices" list
