@platform
@mediaRelaySets
@platform06
@platform06-1

Feature: Media relay sets admin page
  As a main operator
  I want to be able to access media relay sets admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
   When I click on "MediaRelaySets" CTA
    And I am on "MediaRelaySets" list

Scenario: I create new brand admin page
  When I click on add button
   And I fill out the form with "platform/mediaRelaySet/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "MediaRelaySets" list
  When I click on "MediaRelaySets" last elements edit button
  Then I compare the form data with "platform/mediaRelaySet/new" data fixture
