@platform
@mediaRelays
@platform06
@platform06-2

Feature: Media relays admin page
  As a main operator
  I want to be able to access media relays admin page
  In order to check and manage them

Background:
  Given I am on the Dashboard
  Given I click on "MediaRelaySets" CTA
   Then I am on "MediaRelaySets" list
    And I can see at least one row
   When I click on "MediaRelaySets" first elements "kamRtpproxy" button
   Then I am on "MediaRelaySetsList_kamRtpproxy" subscreen list

Scenario: I can create media relays
  Given I click on add button
    And I fill out the form with "platform/mediaRelay/new" data fixture
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "MediaRelaySetsList_kamRtpproxy" subscreen list
  When I click on "kamRtpproxy" last elements edit button
  Then I compare the form data with "platform/mediaRelay/new" data fixture

Scenario: I can edit media relay
  Given I can see at least one row
   When I click on "kamRtpproxy" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "MediaRelaySetsList_kamRtpproxy" subscreen list

Scenario: I can click on delete media relay button
  Given I can see at least one row
   When I click on "kamRtpproxy" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "MediaRelaySetsList_kamRtpproxy" subscreen list
