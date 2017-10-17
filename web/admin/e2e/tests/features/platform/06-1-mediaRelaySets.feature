@platform
@mediaRelaySets
@06-1

Feature: Media relay sets admin page
  As a main operator
  I want to be able to access media relay sets admin page
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on "MediaRelaySets" CTA
    And I am on "MediaRelaySets" list

Scenario: I see new brand admin page
  When I click on add button
   And I fill out the form with "platform/mediaRelaySet/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "MediaRelaySets" list
