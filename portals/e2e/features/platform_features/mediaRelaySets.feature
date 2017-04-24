@platform
@mediaRelaySets

Feature: Media relay sets admin page
  As a main operator
  I want to be able to access media relay sets admin page
  In order to check and manage them

Background:
  Given I go to the admin page
  And I send valid admin credentials
  Then I am logged in
  Given I click on "MediaRelaySets" CTA
  And I am on "MediaRelaySets" list

Scenario: I see new brand admin page
  Given I click on add button
  And I click on close button
  Then I am on "MediaRelaySets" list
