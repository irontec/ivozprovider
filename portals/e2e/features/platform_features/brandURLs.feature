@platform
@brandURLs

Feature: Brand url admin page
  As a main operator
  I want to be able to access brand url admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  And I click on "Brands" CTA
  And I am on "Brands" list
  Then I can see at least one row
  Given I click on "Brands" first elements "brandURLs" button
  Then I am on "BrandsList_brandURLs" subscreen list

Scenario: I can save brand urls
  Given I can see at least one row
  And I click on "BrandURLs" first elements edit button
  And I click on save button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "BrandsList_brandURLs" subscreen list

Scenario: I see new brand operator admin page
  Given I click on add button
  And I click on close button
  Then I am on "BrandsList_brandURLs" subscreen list

Scenario: I can click on delete brand button
  Given I can see at least one row
  And I click on "BrandURLs" first elements delete button
  Then I can see save confirmation dialog
  Given I click on close dialog button
  Then I am on "BrandsList_brandURLs" subscreen list
