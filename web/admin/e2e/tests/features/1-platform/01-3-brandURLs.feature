@platform
@brandURLs
@platform01
@platform01-3

Feature: Brand url admin page
  As a main operator
  I want to be able to access brand url admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on "Brands" CTA
   Then I am on "Brands" list
    And I can see at least one row
   When I click on "Brands" first elements "brandURLs" button
   Then I am on "BrandsList_brandURLs" subscreen list

Scenario: I can create brand operators
  When I click on add button
   And I fill out the form with "platform/brandURL/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "BrandsList_brandURLs" subscreen list
  When I click on "brandURLs" last elements edit button
  Then I compare the form data with "platform/brandURL/new" data fixture

Scenario: I can save brand urls
  Given I can see at least one row
   When I click on "BrandURLs" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "BrandsList_brandURLs" subscreen list

Scenario: I can click on delete brand button
  Given I can see at least one row
   When I click on "BrandURLs" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "BrandsList_brandURLs" subscreen list
