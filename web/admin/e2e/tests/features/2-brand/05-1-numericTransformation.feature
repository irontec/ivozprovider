@brand
@numericTransformation
@transformationRulesetGroupsTrunks
@brand05
@brand05-1

Feature: Numeric transformations admin page
  As a main operator
  I want to be able to access numeric transformation admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "TransformationRuleSets" CTA
   Then I am on "TransformationRuleSets" list

Scenario: I can create new numeric transformation admin
  Given I click on add button
    And I fill out the form with "brand/numericTransformation/new" data fixture
   When I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRuleSets" list
  When I click on "TransformationRuleSets" last elements edit button
  Then I compare the form data with "brand/numericTransformation/compareNew" data fixture

Scenario: I can create new numeric transformation with auto generated rules
  Given I click on add button
    And I fill out the form with "brand/numericTransformation/auto" data fixture
   When I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRuleSets" list
  When I click on "TransformationRuleSets" last elements edit button
  Then I compare the form data with "brand/numericTransformation/compareAuto" data fixture

Scenario: I can edit numeric transformations
  Given I can see at least one row
   When I click on "TransformationRuleSets" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRuleSets" list

Scenario: I can click on delete numeric transformation button
  Given I can see at least one row
   When I click on "TransformationRuleSets" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "TransformationRuleSets" list
